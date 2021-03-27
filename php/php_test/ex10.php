<!-- 
10. Создать переменную $num. 
Создать функцию minusNumber, 
которая будет принимать эту переменную и менять её внутри функции. 
В себе она вычитает из него 1, если число больше 3 - вызывает себя. Использовать рекурсию. 
Вызов функции должен быть minusNumber($num); echo $num;
 , а не $num = minusNumber($num); 
-->

<?php

$num = 10;
print "\nOriginal number: '$num'";

print "\nCalling minusNumber(\$num)...";
minusNumber($num);//в вызове способ передачи аргументов не указывается
 
print "\nThe number after function call: '$num'";

function minusNumber(int &$number) //в прототипе указываем передачу по ссылке
{
    $number -= 1;

    if ($number > 3)
        minusNumber($number);
}

?>