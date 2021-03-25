<!-- 
3. Создать функцию checkFunc(), в которую передавать один параметр. 
    Если параметр не число - отдавать false, 
    если число - проверить, больше ли оно 170, 
        если больше - отдавать "Big", иначе - "Small".
 -->

<?php

$test_types = array(
    'big_int' => 175,
    'small_int' => 165,
    'double' => 10.0,
    'str' => "string",
    'ch' => 'c',
    'bool' => true
);

foreach ($test_types as $type => $value) {
    print "\nType is \"{$type}\" and value is \"{$value}\"";
    $result = check_size($value);
    print "\nFunction have returned: $result ";
}


function check_size($arg)
{
    if (is_int($arg) or is_double($arg)) {
        if ($arg > 170)
            return "Big";
        else if ($arg <= 170)
            return "Small";
        
    }
    else return false;
}
