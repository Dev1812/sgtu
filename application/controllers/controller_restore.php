<?php
class Controller_Restore extends Controller {

  public $i18n;
  public $view;
  public $security;
  public $model;

  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->security = new Security;
    $this->model = new Model_Restore;
    $this->security->setSessionName('restore_hash');
  }

  function action_index() {
    $i18n = $this->i18n->get(array('restore','restore_text','your_email','your_password','short_email','restore_err'));
    $param['css'] = array('restore');
    $param['title'] = $lang['restore'];
    $data['form_hash'] = $this->security->getCSRFToken();
    if(!empty($_GET['c'])) {
      switch ($_GET['c']) {
        case 1:
          $data['restore'] = array('err'=>true,'err_msg'=>$i18n['short_email']);
          break;
        case 2:
          $data['restore'] = array('err'=>true,'err_msg'=>$i18n['short_password']);
          break;
        case 10:
          $data['restore'] = array('err'=>true,'err_msg'=>$i18n['login_err']);
          break;
      }
    }
    $this->view->generate('restore_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_submit() {
    $restore = $this->model->restore($_POST['email']);

    switch ($restore['err']) {
      case true:
        if($restore['err_code']) {
          header('Location: /restore/index/?c='.intval(htmlentities($restore['err_code'])));
        }
        break;
      case false:
        if(!empty($restore['redirect_uri'])) {
          header('Location: '.$restore['redirect_uri']);
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