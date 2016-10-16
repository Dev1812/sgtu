<?php
class Controller_Reg extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Reg;
  }

  function action_index() {
    if($_POST['reg']) {
      $this->reg();
      return false;
    }
    $i18n = $this->i18n->get(array('reg','reg_text','your_name','your_lastname','your_email','your_password','register'));
    $param['css'] = array('reg');
    $param['title'] = $i18n['reg'];
    $this->view->generate('reg_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function reg() {
    /*if(!$this->security->checkCSRFToken($_POST['form_hash'])) {
      return array('err'=>true,'err_msg'=>'Ошибка');
    }*/
    $reg = $this->model->reg($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password']);
    if($_POST['ajax'] == 1) {
      echo json_encode($reg);
      return false;
    } else {
      if($reg['err'] == false) {
        if($reg['url']) {
          header('Location: '.$reg['url']);
        } 
      } else {
        if($reg['err_msg']) {
          $data['reg_msg'] = $reg['err_msg'];
        }
      }
    }
    $this->view->generate('reg_view.php', 'template_view.php', $param, $data, $i18n);

  }

}