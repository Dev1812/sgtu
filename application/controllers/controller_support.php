<?php

class Controller_Support extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $lang = $this->i18n->get(array('contacts'));
    $param['title'] = $lang['contacts'];
    $param['css'] = array('contacts');
    $param['js'] = array('https://maps.googleapis.com/maps/api/js');
    $this->view->generate('contacts_view.php', 'template_view.php', $param, array());

  }

}