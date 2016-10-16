<?php
class Date{

  public $i18n;

  public function __construct() {
    $this->i18n = new i18n;
    $this->common = new Common;
  }

  public function getFullDate($ts) {
    if(!is_numeric($ts)) return false;
    $ts_date = date('d m Y');
    list($day, $month, $year) = explode(' ', $ts_date);
    return $day.' '.$this->common->getMonth($month).' '.$year;
  }

  /**
   * @desc Получение даты из timestamp
   * @date 20:17 22.04.2016
   * @example сегодня в 12:40
   * @return <String> Сокращённую дату
   */
  public function parseTimestamp($ts) {
    if(!$ts || !is_numeric($ts)) return false;

    $ts_date = date('h:i j n Y', $ts);
    list($ts_time, $ts_day, $ts_month, $ts_year) = explode(' ', $ts_date);
 
    $date = date('j n Y');
    list($day, $month, $year) = explode(' ', $date);
    
    if($year != $ts_year) {
      return $ts_day.' '.$this->common->getShortMonth($ts_month).' '.$ts_year;//21 дек 2014
    } else {
      if($day == $ts_day) {
        return 'сегодня в '.$ts_time;//сегодня в 11:40
      } elseif($day == $ts_day - 1) { //вчера
        return 'вчера в '.$ts_time;//вчера в в 11:40
      } else {
        return $ts_day.' '.$this->common->getShortMonth($ts_month).' в '.$ts_time;//9 дек в 14:32
      }
    }
  } 

}
?>