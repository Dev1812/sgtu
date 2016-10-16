<?php
class Model_Forum extends Model {

  public $max_rows = 10;
  const NO_PHOTO = '/images/no_photo.png';

  public $database;
  public $date;
  public $user;
  public $log;
  
  public function __construct() {
    $this->database = DataBase::connect();
    $this->date = new Date;
    $this->user = new User;
    $this->log = new Log;
  }
  
  public function getQuestions($offset = 0) {
    $offset = intval($offset);
    $sql = "SELECT `id`, `owner_id`, `title`, `date_created` FROM `forum_rooms` ORDER BY `id` DESC LIMIT :offset, :max_rows";
    /**
     * array(user_id => <String>'Firstname Lasname')
     */
    $owners_cache = array();
    
    try {
      $get_question = $this->database->prepare($sql);
      $get_question->bindParam(':offset', $offset, PDO::PARAM_INT);
      $get_question->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
      $get_question->execute();
      while($row = $get_question->fetch(PDO::FETCH_ASSOC)) {
        $oid = $row['owner_id'];
        if($owner_cache[$oid]) {
          $row['owner_initials'] = $owner_cache[$oid];
        } else {
          $initials = $this->user->getInitials($oid);
          $row['owner_initials'] = $initials;
          $owners_cache[$oid] = $initials;
        }

        $row['date'] = $this->date->parseTimestamp($row['date_created']);
        $arr[] = $row;
      }
    } catch (PDOException $e) {
      $this->log->write('['.__FILE__.':'.__LINE__.'] Ошибка базы данных');
    }

    $has_more = false;
    if(count($arr) >= $this->max_rows) {
      $has_more = true;
    }

    $offset = $offset + $this->max_rows;
    return array('err'=>false,'html'=>$arr,'has_more'=>$has_more,'offset'=>$offset);
  }



  
  function getRoomMessages($question_id, $offset = 0) {
    $room_id = intval($question_id);
    $offset = intval($offset);
    $max_rows = 10;
    //array( owner_id => array(owner_initials=>'initials',small_photo=>'src',big_photo=>'src') )
    $owner_cache = array(); 
    try {
      $get_msg = $this->database->prepare("SELECT `id`, `owner_id`, `text`, `date_created` FROM `forum_messages` WHERE `room_id` = :room_id ORDER BY `id` DESC LIMIT :offset, :max_rows");

      $get_msg->bindParam(':room_id', $room_id, PDO::PARAM_INT);
      $get_msg->bindParam(':offset', $offset, PDO::PARAM_INT);
      $get_msg->bindParam(':max_rows', $max_rows,  PDO::PARAM_INT);
      $get_msg->execute();

      while($row = $get_msg->fetch(PDO::FETCH_ASSOC)) {
        $oid = $row['owner_id'];
        if($owner_cache[$oid]) {
          $row['owner_initials'] = $owner_cache[$oid]['owner_initials'];
          $row['small_photo'] = $owner_cache[$oid]['small_photo'];
        } else {
          $owner_info = $this->user->getInfo($oid, 'first_name, last_name, small_photo');
          $owner_initials = $owner_info['first_name'].' '.$owner_info['last_name'];
          $small_photo = $owner_info['small_photo'] ?
                         $owner_info['small_photo'] :
                         self::NO_PHOTO;
          $row['owner_initials'] = $owner_initials;
          $row['small_photo'] = $small_photo;
          $owner_cache[$oid] = array('owner_initials'=>$owner_initials,
                                     'small_photo' => $small_photo);
        }
        $row['date'] = $this->date->parseTimestamp($row['date_created']);
        $arr[] = $row;
      }
    } catch (PDOException $e) {
      $this->log->write('['.__FILE__.':'.__LINE__.'] Ошибка базы данных');
    }


    $has_more = false;

    if(count($arr) >= $this->max_rows) {
      $has_more = true;
    }

    $offset = $offset + $this->max_rows;
    return array('err'=>false,'html'=>$arr,'has_more'=>$has_more,'offset'=>$offset);
  }

}
?>