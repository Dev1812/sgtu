<?php

class Controller_Contacts extends Controller {

  public $i18n;
  public $view;
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $lang = $this->i18n->get(array('contacts'));
    $param['title'] = $lang['contacts'];
    $param['css'] = array('contacts');
    $this->view->generate('contacts_view.php', 'template_view.php', $param, array());
  }

}