  <?php
  function calc_craft($given_res): float //возвращает число крафтов (в тоннах) с остатком (в граммах), которое можно создать из переданного ресурса (в тоннах)
  {
    $precision = 6; //требуемое число знаков после запятой, при необходимости преревода тонн в граммы
    $res_required = 7; //ресурсов на один крафт
    $float_res_crafted = $given_res / $res_required;
    return round($float_res_crafted, $precision);
  }

  $given_res = 32; //данный ресурс

  $float_result = calc_craft($given_res); //результат float
  print "\n";
  print $float_result;

  $int_result = intval($float_result); //целая часть (результат)
  print "\n";
  print $int_result;

  $fract_result = $float_result - $int_result; //дробная часть (остаток, в тоннах)
  print "\n";
  print $fract_result;

  $converter_coef = pow(10, 6); //для перевода из тонн в граммы
  print "\n";
  print $converter_coef;

  $fract_result_converted = $fract_result * $converter_coef; //остаток в граммах
  print "\n";
  print $fract_result_converted;

  print "\nСоздано $int_result штук";
  if ($fract_result)
    print ", остаток: {$fract_result_converted} грамм";
