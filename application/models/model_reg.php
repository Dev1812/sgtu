<?php
class Model_Reg extends Model{

  const MIN_FIRSTNAME = 4;
  const MAX_FIRSTNAME = 70;

  const MIN_LASTNAME = 4;
  const MAX_LASTNAME = 70;

  const MIN_EMAIL = 4;
  const MAX_EMAIL = 90;

  const MIN_PASSWORD = 4;
  const MAX_PASSWORD = 90;

  public $i18n;
  public $database;
  public $crypto;
  public $user;

  public function __construct() {
    if(!empty($_SESSION['user_id'])) {
      header('Location: /id'.$_SESSION['user_id']);
    }
    $this->i18n = new i18n;
    $this->database = DataBase::connect();
    $this->crypto = new Crypto;
    $this->user = new User;
  }

  public function reg($firstname, $lastname, $email, $password) {
    $firstname_length = mb_strlen($firstname);
    $lastname_length = mb_strlen($lastname);
    $email_length = mb_strlen($email);
    $password_length = mb_strlen($password);
    $password = addslashes(htmlspecialchars(strip_tags($password)));


    if($firstname_length < self::MIN_FIRSTNAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_firstname'));
    } elseif($firstname_length > self::MAX_FIRSTNAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('long_firstname'));
    }  elseif(!preg_match('/^[a-zа-яё]{4,70}$/ui', $firstname )) {
      return array('err'=>true, 'err_msg'=>$this->i18n->get('incorrect_firstname'));    
    }

    if($lastname_length < self::MIN_LASTNAME) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('short_lastname'));
    } elseif($lastname_length > self::MAX_LASTNAME) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('long_lastname'));
    }  elseif(!preg_match('/^[a-zа-яё]{4,70}$/ui', $lastname)) {
      return $err = array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_lastname'));    
    }


    if($email_length < self::MIN_EMAIL) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('short_email'));
    } elseif($email_length > 70) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('long_email'));
    }  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $err = array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_email'));    
    }


    if($password_length < self::MIN_PASSWORD) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('short_password'));
    } elseif($password_length > self::MAX_PASSWORD) {
      return $arr = array('err'=>true,'err_msg'=>$this->i18n->get('long_password'));
    } elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{4,90}$/ui',$password)) {
      return $err = array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_password'));    
    }

    $is_have_email = $this->database->prepare("SELECT `id` FROM `users` WHERE `email` = :email");
    $is_have_email->execute(array(':email' => $email));
    $row = $is_have_email->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['id'])) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('have_email'));
    }

    $password_hashing = $this->crypto->passwordHashing($password);
    $hashed_password = $password_hashing['hashed_password'];
    $salt = $password_hashing['salt'];
    $hash = $this->crypto->generateHash();
    $date_reg = time();
    $ip = $this->user->getIp();
    $lang = $this->user->getLang();
    $reg = $this->database->prepare("INSERT INTO `users`(`id`, `first_name`, `last_name`, `email`, `phone`, `date_reg`, `date_birth`, `ip`,
                                                         `hashed_password`, `salt`, `lang`, `small_photo`, `big_photo`, `ban_time`, `sex`,
                                                         `user_type`, `university_id`, `university_direction_id`, `course_num`) VALUES (
                                                         '',:first_name,:last_name,:email,'',:date_reg,'',:ip,
                                                         :hashed_password,:salt,:lang,'','','','',1,
                                                         '','','')");
    $reg->execute(array(':first_name' => $firstname,
                        ':last_name' => $lastname,
                        ':email' => $email,
                        ':date_reg' => $date_reg,
                        ':ip'=>$ip,
                        ':hashed_password' => $hashed_password,
                        ':salt' => $salt,
                        ':lang' => $lang));
    $last_id = $this->database->lastInsertId();
    $_SESSION['user_id'] = $last_id;
    $_SESSION['user_lang'] = $lang;
    return array('err'=>false,'url'=>'/id'.$last_id);
  }
}
?>