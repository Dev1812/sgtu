<?php
class Model_Main extends Model {

  public $max_rows = 20;

  public $database;
  public $date;
  public $user;

  public function __construct() {
    $db = new DataBase;
    $this->database = $db->connect();
    $this->date = new Date;
    $this->user = new User;
  }
  
  public function getPosts($offset = 0){
    $has_more = false;
    $offset = intval($offset);
    $sql = "SELECT `id`, `title`, `text`, `date_created`, `owner_id`, `is_deleted` FROM `news` WHERE `is_deleted` = 0 ORDER BY `id` DESC LIMIT :offset, :max_rows"; 
    $get_posts = $this->database->prepare($sql);
    $get_posts->bindParam(':offset', $offset, PDO::PARAM_INT);
    $get_posts->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
    $get_posts->execute();

    /**
     * array(user_id => <String>'Firstname Lasname')
     */
    $owners_cache = array();
    
    while($row = $get_posts->fetch(PDO::FETCH_ASSOC)) {
      $oid = $row['owner_id'];

      if($owners_cache[$oid]) {
        $row['owner_initials'] = $owners_cache[$oid];
      } else {
        $initials = $this->user->getInitials($oid);
        $row['owner_initials'] = $initials;
        $owners_cache[$oid] = $initials;
      }

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