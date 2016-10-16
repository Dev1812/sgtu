<?php

class Controller_Login extends Controller {

  public $i18n;
  public $view;
  public $security;
  public $model;

  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->security = new Security;
    $this->model = new Model_Login;
    $this->security->setSessionName('login_hash');
  }

  function action_index() {
    $i18n = $this->i18n->get(array('login','login_text','your_email','your_password','login','forgot_password','short_email','short_password','login_err'));
    $param['css'] = array('login');
    $param['title'] = $lang['login'];
    $data['form_hash'] = $this->security->getCSRFToken();
    if(!empty($_GET['c'])) {
      switch ($_GET['c']) {
        case 1:
          $data['login'] = array('err'=>true,'err_msg'=>$i18n['short_email']);
          break;
        case 2:
          $data['login'] = array('err'=>true,'err_msg'=>$i18n['short_password']);
          break;
        case 10:
          $data['login'] = array('err'=>true,'err_msg'=>$i18n['login_err']);
          break;
      }
    }
    $this->view->generate('login_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_submit() {
    $login = $this->model->login($_POST['email'], $_POST['password']);

    switch ($login['err']) {
      case true:
        if($login['err_code']) {
          header('Location: /login/index/?c='.intval(htmlentities($login['err_code'])));
        }
        break;
      case false:
        if(!empty($login['redirect_uri'])) {
          header('Location: '.$login['redirect_uri']);
        }
        break;
    }
  }

  function action_a_get_form() {
    $data['form_hash'] = $this->security->getCSRFToken();
    $i18n = $this->i18n->get(array('auth','login_text','your_email','your_password','login','forgot_password'));
    $this->view->generate('', '/ajax/login_form.php', array(), $data, $i18n);
  }

  public function action_a_submit() {
    if(!$this->security->checkCSRFToken($_POST['form_hash'])) {
      $data['ajax'] = array('err'=>true, 'err_msg'=>$this->i18n->get('unknown_error'));
    } else {
      $data['ajax'] = $this->model->login($_POST['email'], $_POST['password']);
    }
    $this->view->generate('', '/ajax/ajax_response.php', array(), $data);
  }
  
}