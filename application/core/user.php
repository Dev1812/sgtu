<?php
class User {
  private $domain;

  function __construct() {
    $this->db = new DataBase;
    $this->database = $this->db->connect();
    $this->domain = $_SERVER['HTTP_HOST'];
  }

  public static function getLang() {
    $uid = (int) $_SESSION['user_id'];
    if($uid) {//is auth
      if($_SESSION['user_lang']) {
        return $_SESSION['user_lang'];
      }
    } else {
      $get_lang = htmlspecialchars(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
      $lang = $get_lang ? $get_lang : 'ru';
      $_SESSION['user_lang'] = $lang;
    }
    return $lang;
  }
  public static function isAuth() {
    return (isset($_SESSION['user_id'])) ? true : false;
  }


    /**
     *     
     * @return <string> User   IP Если IP верно
     * @return <boolean> false Если IP не верно
     *
     */
	public function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }
        return $ip;
	}

    public function cameFrom() {
        $from = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
        if ($from !== false) {
            return $from;
        } else {
            return '/';
        }
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