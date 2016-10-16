<?php
class Model_News extends Model {

  public $max_rows = 10;

  public $database;
  public $date;
  public $user;
  public $log;
  public $i18n;

  function __construct() {
    $this->database = DataBase::connect();
    $this->date = new Date;
    $this->user = new User;
    $this->log = new Log;
    $this->i18n = new i18n;
  }
  
  public function getNews($offset = 0) {
    $offset = intval($offset);
    $sql = "SELECT `id`, `owner_id`, `title`, `text`, `date_created` FROM `news` WHERE `is_deleted` = '0' ORDER BY `id` DESC LIMIT :offset, :max_rows";
    /**
     * array(user_id => <String>'Firstname Lasname')
     */
    $owners_cache = array();
    
    try {
      $get_news = $this->database->prepare($sql);
      $get_news->bindParam(':offset', $offset, PDO::PARAM_INT);
      $get_news->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
      $get_news->execute();
      while($row = $get_news->fetch(PDO::FETCH_ASSOC)) {
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

    if(count($arr) >= $max_rows) {
      $has_more = true;
    }
    $offset = $offset + $max_rows;
    return array('err'=>false,'html'=>$arr,'has_more'=>$has_more,'offset'=>$offset);
  }

  function getOneNews($news_id) {
    $news_id = intval($news_id);
    try {
      $get_news = $this->database->prepare("SELECT `id`, `owner_id`, `title`, `text`, `date_created`, `is_deleted` FROM `news` WHERE `id` = :news_id");
      $get_news->bindParam(':news_id', $news_id, PDO::PARAM_INT);
      $get_news->execute();
      $row = $get_news->fetch(PDO::FETCH_ASSOC);
      if(empty($row['title'])) {
        return array('err'=>true,'err_msg'=>$this->i18n->get('news_not_found'));
      }
      $row['owner_initials'] = $this->user->getInitials($row['owner_id']);
      $row['date'] = $this->date->parseTimestamp($row['date_created']);
      return $row;
    } catch (PDOException $e) {
       $this->log->write('['.__FILE__.':'.__LINE__.'] Ошибка базы данных');
    }
  }

}
?>