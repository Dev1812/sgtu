<?php
class Lang {

  private $lang;

  /**
   * @example array('lang' => array('key' => 'value'))
   *
   */
  public $cache = array();


  public function __construct() {
    $this->lang = User::getLang();
  }

  private function openFile($path) {
    foreach($this->cache as $k => $v) {
      if($k == $this->lang) {
        return $v;
      }
    }
    $file_content = include $path;
    $this->cache[$this->lang] = $file_content;
    return $file_content;
  }

  /**
   * @desc Функция для локализации.
   * @return Строка с языком, указанным выше.
   *
   */
  public function getLang($word) {
    $lang_file_path = SITE_ROOT.'application/lang/'.$this->lang.'.php';
    $lang_file = $this->openFile($lang_file_path);
    if(is_array($word)) {
      foreach($word as $v) {
        if(!empty($lang_file[$v])) {
          $arr[$v] = $lang_file[$v];
        }
      }
      return $arr;
    } 
    if(!empty($lang_file[$word])) {
      return $lang_file[$word];
    }
    return '';
  }


}
?>