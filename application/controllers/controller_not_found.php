<?php

class Controller_Not_Found extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('page_not_found','page_not_found_text', 'to_main'));
    $param['css'] = array('not_found');
    $param['title'] = $i18n['page_not_found'];
    $this->view->generate('not_found_view.php', 'template_view.php', $param, $data, $i18n);

  }

}