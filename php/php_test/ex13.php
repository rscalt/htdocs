<!-- 
    13. Создайте массив продуктов с параметрами id, price, name. 
    Выведите каждый товар в виде "id. name - price". 
    После каждого добавьте форму с кнопкой купить. 
    Сделать обработку этой кнопки с добавлением товара в корзину. 
    Сделать через сессию. 
    При повторном нажатие, если товар уже в корзине, то его количество должно увеличиваться на 1. 
    Снизу сделать вывод, что уже есть в корзине. 
-->

<?php

global $last_id;
$last_id = 0;

class Product
{
    private $id;
    private $price;
    private $name;

    public function showProduct()
    {
    print "\n $this->id";
    print "\n $this->name";
    print "\n $this->price";
    }

    //конструктор, но не конструктор
    public static function createProduct(string $new_name, float $new_price)
    {
        $instance = new Product;
        $instance->id = $GLOBALS['last_id']++;
        $instance->name = $new_name;
        $instance->price = $new_price;
        return $instance;
    }
}

$prod_arr = array(
    'bread' => array(Product::createProduct('bread1_test_name', random_int(0,100)),
                     Product::createProduct('bread2_test_name', random_int(0, 100))),
    
    'milk'  => array(Product::createProduct('milk1_test_name', random_int(0, 100)), 
                     Product::createProduct('milk2_test_name', random_int(0, 100)), 
                     Product::createProduct('milk1_test_name', random_int(0, 100))),
    
    'sugar' => array(Product::createProduct('sugar1_test_name', random_int(0, 100)))
);

//print_r($prod_arr);

foreach ($prod_arr as $group => $Product_obj_array)
print "\n $group";
foreach($Product_obj_array as $key)
print "\n $key _ $value";
?>