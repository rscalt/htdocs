<!-- 
4. Создать функцию HowManyBetween(), 
которая будет принимать два значения и будет отдавать разницу между большим и меньшим. 
Учесть, что могут быть не числа, отдавать ошибку с соответствующим текстом. 
Функция должна сама понимать какое из чисел меньшее.     
 -->

<?php

function HowManyBetween($arg1, $arg2)  : int|float|string //возвращает разницу между большим и меньшим аргументом, 
                                        //порядок аргументов любой
                                        //строгий возврат можно через перегрузку
{
   $first_is_valid = is_int($arg1) || is_double($arg1); //проверка значений
   $second_is_valid = is_int($arg2) || is_double($arg2);

    if ($first_is_valid && $second_is_valid) //есть более аккуратные проверки()?
    {
        if ($arg1 > $arg2)
            return ($arg1 - $arg2);
        else
            return ($arg2 - $arg1);
    } 
    else return "ERROR: Invalid argument type! (Non-numeric types are not allowed)";
    
};


$arg1 = true;
$arg2 = 3;

echo HowManyBetween($arg1, $arg2);
