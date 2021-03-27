<!-- 9. 
Создайте функцию Pyramid(), 
которая будет принимать одна значение - число строк. 
Она должна формировать пирамиду, как на рисунке. 
-->
<?php
$lines = 5;
echo Pyramid($lines);

function Pyramid(int $lines)
{
    for ($i = 0; $i < $lines; $i++) {
        print "\n";
        for ($j = 0; $j <= $i; $j++) {
            print $i;
        }
    } 
}
?>