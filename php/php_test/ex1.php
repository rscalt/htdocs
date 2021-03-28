<?php
$arr = array('a' => 12, 'b' => 2, 'c' => 4);

print "Original array: \n";
print_r($arr);

print "Function result: \n";
print sum_str($arr);

function sum_str($array) : string //возвращает строку вида "abc sum_arr()*13", где 'a', 'b', 'c' - ключи
{
    $str_sum_keys = ''; //конкатенированная строка ключей-литералов
    $sum_values = 0; //сумма значений по соотв. ключам
    $modifier = 13; //множитель
    $space = " ";

    foreach ($array as $key => $value) {
        $str_sum_keys .= $key;
        $sum_values += $value; //arr_sum() не используется для единообразия
    }

    $str_sum_values_mod = (string)($sum_values*$modifier); //умножаем сумму на 13 и переводим в строчный формат
    $result = $str_sum_keys.$space.$str_sum_values_mod;

    return $result;
}
