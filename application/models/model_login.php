<?php
class Model_Login extends Model{

  const MIN_EMAIL = 4;
  const MAX_EMAIL = 90;

  const MIN_PASSWORD = 4;
  const MAX_PASSWORD = 90;

  public $i18n;
  public $database;
  public $crypto;
  public $user;

  public function __construct() {
    $this->i18n = new i18n;
    $db = new DataBase;
    $this->database = $db->connect();
    $this->crypto = new Crypto;
    $this->user = new User;
  }

  public function login($email, $password) {
    $email_length = mb_strlen($email);
    $password_length = mb_strlen($password);
    $password = addslashes(htmlspecialchars(strip_tags($password)));

    if($email_length < self::MIN_EMAIL) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_email'),'err_code'=>'1');
    }
    if($email_length > 70 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('login_err'),'err_code'=>'10');
    }

    if($password_length < self::MIN_PASSWORD) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_password'),'err_code'=>'2');
    } elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{4,90}$/ui',$password)) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('login_err'),'err_code'=>'10'); 
    }

    $get_info= $this->database->prepare("SELECT `id`, `hashed_password`, `salt`, `lang`, `ban_time` FROM `users` WHERE `email` = :email");
    $get_info->execute(array(':email' => $email));
    $row = $get_info->fetch(PDO::FETCH_ASSOC);

    if(empty($row['id'])) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('login_err'),'err_code'=>'10');
    } 

    if(!$this->crypto->checkPassword($row['hashed_password'], $password, $row['salt'])) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('login_err'),'err_code'=>'10');
    }

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_lang'] = $row['lang'];
    return array('err'=>false,'redirect_uri'=>'/id'.$row['id']);
  }
}
?>