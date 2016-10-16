<?php
class Log {

  /**
   * @desc Функция для записи в лог
   * @date 30.03.3016
   * @param <Text> text - Текст для записи
   *
   */
  public function write($text) {
    $ip = User::getIp();
    $path = SITE_ROOT.'application/logs/'.date('d.m.Y').'.txt';
    $time = date('h:i:s');
    $text_to_log = "\n[$time][$ip]$text";
    $file = fopen($path, 'a+');
    flock($file, LOCK_EX);
    fwrite($file, $text_to_log);
    flock($file, LOCK_UN); //Снятие блокировки
    fclose($file);
  }

}
?>