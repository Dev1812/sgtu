<?php
class Model_Albums extends Model {

  public $max_rows = 10;

  public $database;
  public $date;
  public $user;

  public function __construct() {
    $this->database = DataBase::connect();
    $this->date = new Date;
    $this->user = new User;
  }
  

  public function getAlbums($offset = 0) {
    $offset = intval($offset);
    $sql = "SELECT `id`, `title`, `photos_counter`, `cover` FROM `albums_room` ORDER BY `id` DESC LIMIT :offset, :max_rows";    
    try {
      $get_albums = $this->database->prepare($sql);
      $get_albums->bindParam(':offset', $offset, PDO::PARAM_INT);
      $get_albums->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
      $get_albums->execute();
      while($row = $get_albums->fetch(PDO::FETCH_ASSOC)) {
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




  public function getPhotos($album_id, $offset = 0) {
    $album_id = intval($album_id);
    $offset = intval($offset);
    $sql = "SELECT `id`, `owner_id`, `album_id`, `title`, `photo_path`, `date_created` FROM `albums_photos` WHERE `album_id` = :album_id ORDER BY `id` DESC LIMIT :offset, :max_rows";
    /**
     * array(user_id => <String>'Firstname Lasname')
     */
    $owners_cache = array();
    
    try {
      $get_photos = $this->database->prepare($sql);
      $get_photos->bindParam(':album_id', $album_id, PDO::PARAM_INT);
      $get_photos->bindParam(':offset', $offset, PDO::PARAM_INT);
      $get_photos->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
      $get_photos->execute();
      while($row = $get_photos->fetch(PDO::FETCH_ASSOC)) {
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
    return array('err'=>false,'html'=>$arr,'album_id'=>$album_id,'has_more'=>$has_more,'offset'=>$offset);
  }


}
?>