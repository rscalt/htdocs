<!-- 
    13. Создайте массив продуктов с параметрами id, price, name. 
    Выведите каждый товар в виде "id. name - price". 
    После каждого добавьте форму с кнопкой купить. 
    Сделать обработку этой кнопки с добавлением товара в корзину. 
    Сделать через сессию. 
    При повторном нажатие, если товар уже в корзине, то его количество должно увеличиваться на 1. 
    Снизу сделать вывод, что уже есть в корзине. 
-->
<?php //классы
class Product
{
    protected $id;
    protected $price;
    protected $name;

    public function showProduct()
    {
        print "\n";
        print "$this->id. ";
        print "$this->name - ";
        print "$this->price";
    }

    protected static function getID() : int //абстрактный метод
    {
        static $last_id = 1; //сохраняем значение ID между вызовами
        $id = $last_id++;
        return $id;
    }

    //метод-конструктор
    public static function createProduct(
        string $new_name, 
        float $new_price) : Product
    {
        $instance = new Product;
        if (isset($instance)) {
            //увеличиваем id только если объект создан успешно
            $new_id = Product::getID();
            $instance->id = $new_id;
            $instance->name = $new_name;
            $instance->price = $new_price;
            return $instance;
        } else return 0;
    }
}

class Basket
{
    public $buy_arr = array(
        'id' => array(),
        'count' => array(),
    );

    public static function createBasket()
    {
        $instance = new Basket;
        if (isset($instance)) {
            $instance->buy_arr['id'] = 5;
            $instance->buy_arr['count'] = 14;
            return $instance;
        } else return 0;
    }

    protected function add_product()
    {
        $basket['id'][] = $_POST['product_id'];
        $basket['count'][]++;
    }

    public function showBasket()
    {
        foreach ($this->buy_arr as $key => $value)
            print "\n{$key}_{$value}";
    }
}
?>

<?php //код страницы

//ручная БД с продуктамии
$prod_db = array(
    'bread' => array(
        Product::createProduct('bread1', 11),
        Product::createProduct('bread2', 22),
    ),

    'milk'  => array(
        Product::createProduct('milk1', 33),
        Product::createProduct('milk2', 44),
        Product::createProduct('milk3', 55)
    ),

    'sugar' => array(
        Product::createProduct('sugar1', 66),
    ),
);

?>

<?php
session_start();

foreach ($prod_db as $group => $object_array) :
    foreach ($object_array as $object) :
?>
        <table>
            <tr>
                <td>
                    <?php $object->showProduct(); ?>
                </td>
                <td>
                    <form action="$_SERVER[PHP_SELF]" method="POST">
                        <input type="submit" name="product_id" value="Купить">
                    </form>
                </td>
            </tr>
        </table>
<?php
    endforeach;
endforeach;
?>

<?php //функции
function print_prod_db(array $prod_arr)
{
    //выводим список продуктов по переданному массиву-корзине
    foreach ($prod_arr as $group => $object_array) {
        foreach ($object_array as $object)
            $object->showProduct(); //10of10
    }
}
?>