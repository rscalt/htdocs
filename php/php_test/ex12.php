<?php
class Product 
{
    private $name;
    private $price;

    public function showPrice()
    {
    //print "\nНаименование товара: $this->name";
    print "\nЦена товара: $this->price";
    }

    //конструктор, но не конструктор
    public static function createProduct(string $new_name, float $new_price)
    {
      $instance = new Product;
      $instance->name = $new_name;
      $instance->price = $new_price;
      return $instance;
    }
}

    $bread = Product::createProduct('MAKFA', 50);
    $bread->showPrice();
