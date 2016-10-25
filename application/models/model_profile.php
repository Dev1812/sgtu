<?php
class Model_Profile extends Model {

  public $database;
  public $date;
  public $user;
  public $log;

  public function __construct() {
    $this->database = DataBase::connect();
    $this->user = new User;
    $this->log = new Log;
    $this->date = new Date;
  }
  
  public function getInfo($uid) {
    $uid = intval($uid);

    try {
      $get_info = $this->database->prepare("SELECT `firstname`, `lastname`, `reg_date`, `birth_date`, `small_photo`, `big_photo`, `university` FROM `users` WHERE `id` = :uid");
      $get_info->bindParam(':uid', $uid,  PDO::PARAM_INT);
      $get_info->execute();
      $row = $get_info->fetch(PDO::FETCH_ASSOC);
      if(empty($row)) {
        header('Location: /not_found');
      }
      $row['reg_date'] = $this->date->getFullDate($row['reg_date']);

      $get_university = $this->database->prepare("SELECT `title` FROM `universities` WHERE `id` = :university_id");
      $get_university->bindParam(':university_id', $row['university'],  PDO::PARAM_INT);
      $get_university->execute();
      $university = $get_university->fetch(PDO::FETCH_ASSOC);
      $row['university'] = $university['title'];
    } catch (PDOException $e) {
      $this->log->write('['.__FILE__.':'.__LINE__.'] Ошибка базы данных');
    }
   return $row;
   
  }

}
?>