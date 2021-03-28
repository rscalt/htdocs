<?php //куки и сессии
session_start();
checkPrevSession();
?>

<?php //классы
class Product
{
    protected $id;
    protected $price;
    protected $name;

    //возвращает все поля продукта
    public function ShowProduct()
    {
        print "$this->id. ";
        print "$this->name - ";
        print "$this->price";
    }

    //возвращает ID конкретного продукта
    public function GetProductID()
    {
        print "$this->id";
    }

    //возвращает имя объекта через его ID; принимает только массив объектов
    public function GetProductNameByID($id, $db)
    {
        foreach ($db as $group => $object_array)
            foreach ($object_array as $object)
                if ($this->id == $id)
                    return $this->name;
    }

    //возвращает ID для присвоения новому продукту
    protected static function GetNewID(): int //для метода-конструктора
    {
        static $last_id = 1; //сохраняем значение ID между вызовами
        $id = $last_id++;
        return $id;
    }

    //возвращает новый продукт с заданными параметрами
    public static function CreateProduct(
        string $new_name,
        float $new_price
    ): Product {
        $instance = new Product;
        if (isset($instance)) {
            //увеличиваем id только если объект создан успешно
            $new_id = Product::GetNewID(); //присваиваем новый уникальный ID
            $instance->id = $new_id;
            $instance->name = $new_name;
            $instance->price = $new_price;
            return $instance;
        } else return -1;
    }
}
?>

<?php //функции
//возвращает результат проверки на наличие сохраненных сессий
//если сохраненных сессий нет - формирует массивы 'id' и 'q' в $_SESSION
function checkPrevSession()
{
    $prev_session_exists = isset($_SESSION['id']) && isset($_SESSION['q']);
    if (!$prev_session_exists) {
        //print "No previous session found! <br>"; //отладка
        //print "Session have been initialized!"; //отладка
        $_SESSION['id'] = [];
        $_SESSION['q'] = []; //количество
        return false; //первая сессия
    } else return true;
}

function resetSession()
{
    $_SESSION = []; //отладка
}

//возвращает список доступных продуктов из массива
function printProdDB(array $prod_arr)
{
    foreach ($prod_arr as $group => $object_array) {
        foreach ($object_array as $object)
            $object->ShowProduct(); //10of10
    }
}

//добавляет товар в корзину (реализация - через сессию)
function addToBasket($post_id)
{
    $id_exists = in_array($post_id, $_SESSION['id'], true); //есть ли в корзине

    if ($id_exists) { //если есть
        $id_pos = array_search($post_id, $_SESSION['id'], null); //то по индексу
        $_SESSION['q'][$id_pos]++; //...увеличиваем на 1; (массивы параллельные)
        return $_SERVER['PHP_SELF']; //обновляем страницу
    } else { //иначе
        $_SESSION['id'][] = $post_id; //добавляем id в конец массива
        $_SESSION['q'][] = 1; //добавляем в конец массива; код более наглядный
        return $_SERVER['PHP_SELF']; //обновляем страницу
    }
}


//выгружает наименование из db по указанной позиции
//вспомогательная для корзины, и, скорее всего, будет переписана
function NameLoader(&$prod_db, $position)
{
    foreach ($prod_db as $group => $object_array)
        foreach ($object_array as $object)
            echo $object->GetProductNameByID($_SESSION['id'][$position], $prod_db);
}

?>

<?php //данные; обработка запросов
//данные из _db в виде массива объектов
$prod_db = array(
    'bread' => array(
        Product::CreateProduct('bread1', 11),
        Product::CreateProduct('bread2', 22),
    ),

    'milk'  => array(
        Product::CreateProduct('milk1', 33),
        Product::CreateProduct('milk2', 44),
        Product::CreateProduct('milk3', 55)
    ),

    'sugar' => array(
        Product::CreateProduct('sugar1', 66),
    ),
);

//обработка запросов
if (
    isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] == 'POST'
) {
    if (isset($_POST['add_prod_id']))
        addToBasket($_POST['add_prod_id']); //добавляем в корзину по $_POST[]
    else if (isset($_POST['resetSession']) && $_POST['resetSession'] = 1) {
        resetSession();
        $_SERVER['PHP_SELF'];
    }
} else $_SERVER['PHP_SELF'];
?>

<?php //контент: витрина 
?>
<h1>Витрина</h1>
<table border="1">
    <th>ID, наим., цена</th>
    <th>Купить</th>
    <?php foreach ($prod_db as $group => $object_array) : ?>
        <?php foreach ($object_array as $object) : ?>
            <tr>
                <td>
                    <?php $object->ShowProduct(); //вывод объектов и кнопки 
                    ?>
                </td>
                <td>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <button name="add_prod_id" type="submit" value="<?= $object->GetProductID() ?>">
                            <b>В корзину</b>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
</table>

<?php if (checkPrevSession()) : //контент: корзина 
?>
    <h1>Корзина</h1>
    <table border="1">
        <th>№</th>
        <th>ID</th>
        <th>Наим-е</th>
        <th>Кол-во</th>
        <?php foreach ($_SESSION['id'] as $position => $value) : ?>
            <tr>
                <td><?= ($position + 1); ?></td>
                <td><?= $_SESSION['id'][$position]; ?></td>
                <td> <?= NameLoader($prod_db, $position); ?></td>
                <td><?= $_SESSION['q'][$position]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <button name="resetSession" value=1> Очистить корзину </button>
    </form>

<?php endif; ?>