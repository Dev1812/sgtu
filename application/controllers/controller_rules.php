<?php

class Controller_Rules extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('rules'));
    $param['css'] = array('rules');
    $param['title'] = $i18n['rules'];
    $this->view->generate('rules_view.php', 'template_view.php', $param, $data, $i18n);
  }

}