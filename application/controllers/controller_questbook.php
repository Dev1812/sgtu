<?php
class Controller_Questbook extends Controller {
  
  public $i18n;
  public $view;
  public $model;
  public $captcha;
  public $security;

  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Questbook;
    $this->captcha = new Captcha;
    $this->security = new Security;
    $this->security->setSessionName('questbook_token');
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('questbook','posts_not_found','notes','load_more','create_note','your_name','your_message','captcha_code','send'));
    $data['form_hash'] = $this->security->getCSRFToken();
    $param['title'] = $i18n['questbook'];
    $param['css'] = array('questbook');
    $param['js'] = array('questbook');
    $get_msg = $this->model->getMessages();
    $data['questbook_msg'] = $get_msg['html'];
    $this->view->generate('questbook_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_a_send() {
    if(!$this->captcha->checkCode($_POST['captcha_code'])) {
      $data['ajax'] = array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_code'),'js'=>'updateCaptcha("captcha_img");ge("captcha_code").focus()');
      $this->view->generate(null, '/ajax/ajax_response.php', array(), $data);
    } else if(!$this->security->checkCSRFToken($_POST['form_hash'])) {
      $data['ajax'] = array('err'=>true,'err_msg'=>'<div class="form_msg_title">'.$this->i18n->get('unknown_error').'</div>');
      $this->view->generate(null, '/ajax/ajax_response.php', array(), $data);
    } else {
      $data['ajax'] = $this->model->send($_POST['name'],$_POST['message']);
      $this->view->generate(null, '/ajax/questbook_send.php', array(), $data);
    }
  }

  public function action_a_get_more() {
    $data['ajax'] = $this->model->getMessages($_GET['offset']);
    $this->view->generate(null, '/ajax/questbook_get_more.php', array(), $data);
  }

}
?>