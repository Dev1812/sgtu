<?php

class Controller_Upload extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
 //   $this->model = new Model_Admin;
    $this->crypto = new Crypto;
  }


  function action_upload() {
    //$data['ajax'] = $this->model->restorePost($_GET['post_id']);
    $data['ajax'] = array('err'=>false,
                          'photo_small_src'=>'/user_files/s_2525d92e6415b9eb10ae6a34a64.jpg',
                          'photo_big_src'=>'/user_files/b_2525d92e6415b9eb10ae6a34a64.jpg',
                          'photo_id'=>rand(1, 7));
    $this->view->generate('', 'ajax/ajax_response.php', array(), $data);
  }

}