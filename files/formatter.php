<?php

  /**
   *  converts a number to a string formatted as US currency without decimal places
   *
   *  @param int|string $value the number to convert to currency
   *  @return string a string containing a number formatted as US currency
   */
  function format_to_money($value){
    $value = "" . $value; //force value to be a string
    $n = strlen($value);
    $formatted = "";
    $count = 0;
    for($i = $n - 1; $i >= 0; $i--){
      if(($count > 1) && ($count % 3 == 0)){
        $formatted = "," . $formatted;
      }
      $formatted = substr($value, $i, 1) . $formatted;
      $count++;
    }
    $formatted = "$" . $formatted;
    return $formatted;
  }

  //tests
  // echo format_to_money(1000) . "<br>";
  // echo format_to_money("1000") . "<br>";
  // echo format_to_money(100000) . "<br>";
  // echo format_to_money("100000") . "<br>";

?>
