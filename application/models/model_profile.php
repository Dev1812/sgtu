<?php
class Model_Profile extends Model {

  public $database;
  public $date;
  public $user;
  public $log;

  function __construct() {
    $this->database = DataBase::connect();
    $this->user = new User;
    $this->log = new Log;
    $this->date = new Date;
  }
  
  public function getInfo($uid) {
    $uid = intval($uid);
  //  $info = $this->user->getInfo($uid, 'first_name, last_name, small_photo, big_photo, date_birth');


     $sql = "SELECT `id`,`university_id` FROM `users` WHERE `id` = 3 INNER JOIN `universities` ON `users.university_id` = `universities.id`";
    /**
     * array(user_id => <String>'Firstname Lasname')
     */
    $owners_cache = array();
    
    try {
      $get_news = $this->database->prepare($sql);
      $get_news->execute();
      while($row = $get_news->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = $row;
      }
    } catch (PDOException $e) {
      $this->log->write('['.__FILE__.':'.__LINE__.'] Ошибка базы данных');
    }
    var_dump($arr);
/*
    SELECT *
FROM
  Person
  INNER JOIN
  City
    ON Person.CityId = City.Id

    */
/*

    if(!isset($info) || empty($info) ) {
      header('Location: /not_found');
    }
    $info['date_birth'] = $this->date->getFullDate($info['date_birth']);
    $info['id'] = $uid;
    return $info;*/
  }

}
?>