<?php
class Security {
	/**
	 * @param <String> words - Строка для усиления токена
	 */
  public $session_name = 'csrf_token';

  public function genCSRFToken($words) {
    $words .= $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : '';
    return substr(sha1($words.uniqid()), 0, 27);
  }
    
  public function saveCSRFToken($token) {
    $_SESSION[$this->session_name] = $token;
  }
    
  public function setSessionName($name) {
    $this->session_name = $session_name;
  }

  public function getCSRFToken($words = '') {
    if($_SESSION[$this->session_name]) {
      return $_SESSION[$this->session_name];
    }
    $token = $this->genCSRFToken($words);
    $this->saveCSRFToken($token);
    return $token;
  }
    
  /**
   * @param <string> $token Токен для проверки
   * @return <boolean> true Если Токен верный
   * @return <boolean> false Если Токен неправильный                  
   *
   */
  public function checkCSRFToken($token) {
    if(empty($token)) return false;
    return ($token == $_SESSION[$this->session_name]) ? true : false;
  }
	
	
}
?>