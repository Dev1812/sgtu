<?php
class Controller_Events extends Controller {
  
  public $i18n;
  public $view;
  public $model;

  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Events;
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('questbook','posts_not_found','notes','load_more','create_note','your_name','your_message','captcha_code','send'));
    $param['title'] = $i18n['questbook'];
    $param['css'] = array('questbook');
    $param['js'] = array('questbook');
    $get_msg = $this->model->getEvents();
    $data['questbook_msg'] = $get_msg['html'];
    $this->view->generate('questbook_view.php', 'template_view.php', $param, $data, $i18n);
  }


  public function action_a_get_more() {
    $data['ajax'] = $this->model->getEvents($_GET['offset']);
    $this->view->generate(null, '/ajax/questbook_get_more.php', array(), $data);
  }


  public function action_a_get() {
    $data['ajax'] = $this->model->getEvents($_GET['offset']);
    $this->view->generate(null, '/ajax/events_get.php', array(), $data);
  }

}
?>