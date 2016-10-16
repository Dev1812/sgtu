<?php
class Model_Questbook extends Model {

  const MIN_NAME = 2;
  const MAX_NAME = 110;
  const MAX_FORM_SEND_TRY = 23;

  public $max_rows = 10;

  public $captcha;
  public $database;
  public $date;
  public $i18n;
  
  public function __construct() {
    $this->captcha = new Captcha;
    $this->database = DataBase::connect();
    $this->date = new Date;
    $this->i18n = new i18n;
  }
  
  public function send($owner_name, $message) {
    $ts = time();

    if($_SESSION['form_questbook_try'] > self::MAX_FORM_SEND_TRY) {
      if($_SESSION['form_questbook_last_ts'] > $ts - 60) {  // 1 minutes
		    return array('err'=>true,'err_msg'=>$this->i18n->get('many_try'));
      } else {
         $_SESSION['form_questbook_try'] = 0;
      }
    } else {
      $_SESSION['form_questbook_try']++;
      $_SESSION['form_questbook_last_ts'] = $ts;
    }

    $owner_name_length = mb_strlen($owner_name);
    $message_length = mb_strlen($message);
    
    $message = htmlspecialchars(strip_tags(mysql_escape_string($message)));

    if($owner_name_length < self::MIN_NAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_firstname'));
    } elseif($owner_name_length > self::MAX_NAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('long_firstname'));
    }  elseif(!preg_match('/^[a-zа-яё]{2,110}$/ui', $owner_name)) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_firstname'));    
    }

    if($message_length < self::MIN_NAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_msg'));
    } elseif($message_length > self::MAX_NAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('long_msg'));
    }

    $sql = "INSERT INTO `questbook_msg`(`id`, `owner_id`, `owner_name`, `text`, `date_created`) VALUES('', :owner_name, :_text, :date_created, 0)";
    $send = $this->database->prepare($sql);
    $send->execute(array('owner_name' => $owner_name,
                         '_text' => $message,
                         'date_created' => $ts));
    $date = $this->date->parseTimestamp($ts);
    return array('err'=>false,'owner_photo'=>'no_photo.png','post_id'=>$this->database->lastInsertId(),'owner_name'=>$owner_name,'text'=>$message,'date'=>$date);     
  }

  public function getMessages($offset = 0){
    $offset = intval($offset);
    $has_more = false;
    $get_message = $this->database->prepare("SELECT `id`, `owner_name`, `text`, `date_created` FROM `questbook_msg` ORDER BY `id` DESC LIMIT :offset, :max_rows");
    $get_message->bindParam(':offset', $offset, PDO::PARAM_INT);
    $get_message->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
    $get_message->execute();
    $dialog_owner = array();
    while($row = $get_message->fetch(PDO::FETCH_ASSOC)) {
      $row['date'] = $this->date->parseTimestamp($row['date_created']);
      $arr[] = $row;
    }

    if(count($arr) > $this->max_rows - 1) {
      $has_more = true;
    }

    $offset = $offset + $this->max_rows;
    return array('err'=>false,'html'=>$arr,'has_more'=>$has_more,'offset'=>$offset);
  }

}
?>