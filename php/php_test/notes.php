<?php //basket class
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