<?php
$num = 10;
print "\nOriginal number: '$num'";

print "\nCalling 'minusNumber(\$num)'...";
minusNumber($num); //в вызове способ передачи аргументов не указывается

print "\nThe number after function call: '$num'";

function minusNumber(int &$number) //в прототипе указываем передачу по ссылке
{
    $number -= 1;

    if ($number > 3)
        minusNumber($number);
}
