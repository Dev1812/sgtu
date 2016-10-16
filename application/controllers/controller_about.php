<?php

class Controller_About extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('about'));
   // $param['css'] = array('about');
    $param['title'] = $i18n['about'];
    $this->view->generate('about_view.php', 'template_view.php', $param, $data);
  }

}