<?php

class Controller_Restore extends Controller {
  
  public $security;
  public $i18n;
  public $view;

  function __construct() {
    $this->security = new Security;
    $this->i18n = new i18n;
    $this->view = new View;
    $this->security->setSessionName('login_hash');
  }

  function action_index() {
    $i18n = $this->i18n->get(array('restore','restore_text','your_email','send'));
    $param['css'] = array('restore');
    $param['title'] = $i18n['restore'];
    $data['form_hash'] = $this->security->getCSRFToken();
    $this->view->generate('restore_view.php', 'template_view.php', $param, $data, $i18n);
  }

}