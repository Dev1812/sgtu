<?php
class Controller_Profile extends Controller {

  public $i18n;
  public $view;
  public $security;
  public $model;

  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Profile;
  }
  public function action_index() {
    header('Location: /not_found');
  }

  public function action_get() {
    $i18n = $this->i18n->get(array('profile','date_birth','university','direction','group'));
    $param['css'] = array('profile');
    $param['title'] = $i18n['profile'];
    $data['profile'] = $this->model->getInfo($_GET['profile_id']);
    $this->view->generate('profile_view.php', 'template_view.php', $param, $data, $i18n);
  }

}