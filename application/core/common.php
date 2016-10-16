<?php
class Common {
  /**
   * @code pluralForm($n, 'письмо', 'письма', 'писем');
   */
  public static function pluralForm($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if($n > 10 && $n < 20) {
      return $form5;
    } elseif($n1 > 1 && $n1 < 5) {
      return $form2;
    } elseif($n1 == 1) {
      return $form1;
    }
    return $form5;
  }
}

?>