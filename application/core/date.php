<?php
class Date{
  public function __construct() {
    $this->i18n = new i18n;
  }

  public function getFullDate($ts) {
    if(!is_numeric($ts)) return false;
    $ts_date = date('d m Y');
    list($day, $month, $year) = explode(' ', $ts_date);
    return $day.' '.$this->getMonthName($month).' '.$year;
  }
/**
 * @desc Получение даты из timestamp
 * @date 20:17 22.04.2016
 * @example 12 марта 2016
 * @return <String> Сокращённую дату
 */
function parseTimestamp($ts) {
  if(!$ts || !is_numeric($ts)) return false;

  $ts_date = date('h:i j n Y', $ts);
  list($ts_time, $ts_day, $ts_month, $ts_year) = explode(' ', $ts_date);
 
  $date = date('j n Y');
  list($day, $month, $year) = explode(' ', $date);
  
  if(!$year == $ts_year) {
    return $ts_day.' '.$this->getShortMonthName($ts_month).' '.$ts_year;//21 дек 2014
  } else {
    if($day == $ts_day) {
      return 'сегодня в '.$ts_time;//сегодня в 11:40
    } elseif($day == $ts_day - 1) { //вчера
      return 'вчера в '.$ts_time;//сегодня в 11:40
    } else {
      return $ts_day.' '.$this->getShortMonthName($ts_month).' в '.$ts_time;//9 дек в 14:32
    }
  }
}


/**
 * @desc Получение иформации(дата, месяц, название месяца, год) из timestamp
 * @date 20:19 22.04.2016
 * @example array('day' => 12, 
 *                'month' => 3,
 *                'month_name' => 'марта',
 *                'year' => 2016)
 * @return <Array> Информацию из timestamp
 */
function getInfoFromTimestamp($ts) {
  if(!$ts || !is_numeric($ts)) return false;
  $ts_date = date('j n Y', $ts);
  list($ts_day, $ts_month, $ts_year) = explode(' ', $ts_date);
  return array('day' => $ts_day, 
               'month' => $ts_month,
               'month_name' => $this->getMonthName($ts_month),
               'year' => $ts_year);
}


/**
 * @desc Получение сокращённой версии даты
 * @date 20:16 22.04.2016
 * @example 12 мар 2016
 * @return <String> Сокращённую дату
 */
function parseTimestampShort($ts) {
  if(!$ts || !is_numeric($ts)) return false;

  $ts_date = date('h:i:s j d n m Y', $ts);
  list($ts_time, $ts_day, $ts_day_full, $ts_month, $ts_month_full,  $ts_year) = explode(' ', $ts_date);
  
  $date = date('j n Y');
  list($day, $month, $year) = explode(' ', $date);
  if($ts_year == $year) {
    if($ts_month == $month) {
      if($ts_day == $day) {
        return $ts_time;
      }
    }
  }
  return $ts_day_full.'.'.$ts_month_full.'.'.$ts_year;
}


 
/**
 * @code pluralForm($n, 'письмо', 'письма', 'писем');
 */
function pluralForm($n, $form1, $form2, $form5) {
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

/**
 * @desc Получение сокращённого названия месяца
 * @date 10.04.2016 9:40
 * @return <String> Сокщённое назваие месяца
 */
function getShortMonthName($num) {
  if(!$num) return false;
  $short_months = $this->i18n->get('short_month');
  if($num < 0 || $num > 12) {
    return false;
  }
  return $short_months[$num];
}

/**
 * @desc Получение названия месяца
 * @date 10.04.2016 9:45
 * @return <String> Сокщённое назваие месяца
 */
function getMonthName($num) {
  if(!$num) return false;
  $months = $this->i18n->get('month');
  if($num < 0 || $num > 12) {
    return false;
  }
  return $this->pluralForm($num, $months[$num][0], $months[$num][1],  $months[$num][1]);
}
}
?>