<?php

class Controller_Restore extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    //$this->route->setRule(array('profile?id=[0-9])' => '/profile/get/?id=$1'));
    $i18n = $this->i18n->get(array('change_lang'));
    $param['css'] = array('lang');
    $param['title'] = $i18n['change_lang'];
    $this->view->generate('restore_view.php', 'template_view.php', $param, $data, $i18n);
  }

}