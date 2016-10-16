<?php
class Controller_News extends Controller {
    
  public $i18n;
  public $view;
  public $model;

  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_News;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('news','load_more','news_not_found'));
    $param['css'] = array('news');
    $param['title'] = $i18n['news'];
    $data['news'] = $this->model->getNews(); 
    $this->view->generate('news_view.php', 'template_view.php', $param, $data, $i18n);
  }

  function action_get() {
    $i18n = $this->i18n->get(array('news','news_not_found'));
    $param['css'] = array('news');
    $param['title'] = $i18n['news'];
    $data['news'] = $this->model->getOneNews($_GET['news_id']); 
    $this->view->generate('news_one_view.php', 'template_view.php', $param, $data, $i18n);
  }

}