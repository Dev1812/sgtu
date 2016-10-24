<?php
class Controller_Reg extends Controller {
   
   public $i18n;
   public $view;
   public $security;
   public $model;

  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->security = new security;
    $this->model = new Model_Reg;
    $this->security->setSessionName('reg_hash');
  }

  public function action_index() {
    $p = $_POST;
    $i18n = $this->i18n->get(array('reg','reg_text','your_name','your_lastname','your_email','your_password','register'));
    $param['css'] = array('reg');
    $param['title'] = $i18n['reg'];
    
    if(isset($p['reg_submit'])) {
      if(!$this->security->checkCSRFToken($p['form_hash'])){
        // incorrect captcha code
        $data['reg'] = array('err'=>true, 'err_msg'=>$this->i18n->get('unknown_error'));
      } else {
        // captcha code is correct, trying to call the Reg model
        $data['reg'] = $this->model->reg($p['first_name'], $p['last_name'], $p['email'], $p['password']);
      }
    }

    $data['form_hash'] = $this->security->getCSRFToken();
    $this->view->generate('reg_view.php', 'template_view.php', $param, $data, $i18n);
  }

}