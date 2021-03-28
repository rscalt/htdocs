<?php
function HowManyBetween($arg1, $arg2): int|float|string
//возвращает разницу между большим и меньшим аргументом, 
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
    } else return "ERROR: Invalid argument type! (Non-numeric types are not allowed)";
};


$arg1 = 5;
$arg2 = 3;

echo "The Result is: ";
echo HowManyBetween($arg1, $arg2);
