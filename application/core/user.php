<?php
class User {

  private $domain;

  function __construct() {
    $this->db = new DataBase;
    $this->database = $this->db->connect();
    $this->domain = $_SERVER['HTTP_HOST'];
  }

  public static function getLang() {
    $user_lang = intval($_SESSION['user_id']);
    return (!empty($user_lang)) ? $user_lang : htmlspecialchars(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
  }

  public static function isAuth() {
    return (!empty($_SESSION['user_id'])) ? true : false;
  }

  /**
   *     
   * @return <string> User   IP Если IP верно
   * @return <boolean> false Если IP не верно
   *
   */
	public static function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if(!filter_var($ip, FILTER_VALIDATE_IP)) {
      return false;
    }
    return $ip;
	}

  public function getInitials($uid) {
    $info = $this->getInfo($uid, 'first_name, last_name');
    return $info['first_name'].' '.$info['last_name'];
  }

  public function getInfo($user_id, $fields) {
    if(!$user_id) return false;
    $user_id = (int) $user_id;
    $getInfo = $this->database->prepare("SELECT $fields FROM `users` WHERE `id` = :user_id");
    $getInfo->execute(array(':user_id' => $user_id));
    return $getInfo->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * @desc Выход
   * @date 9.04.2016
   *
   */
  public function logOut() {
    session_unset();
    session_destroy();
    header('Location: /');
  }
}

?>