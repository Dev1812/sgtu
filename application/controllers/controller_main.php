<?php

class Controller_Main extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Main;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('welcome', 'news_not_found', 'read_more', 'welcome_title', 'welcome_text'));
    $param['css'] = array('index');
    $param['title'] = $i18n['welcome'];
    $data['news'] = $this->model->getPosts();
    $this->view->generate('main_view.php', 'template_view.php', $param, $data, $i18n);
  }

  function action_get() {
    $lang = $this->i18n->get(array('post'));
    $data['post'] = $this->model->getPost($_GET['news_id']);
	$title = str_replace($lang['post'], '%title%', $data['post']['title']);
    $param['title'] = $title;
    $this->view->generate('post_view.php', 'template_view.php', $param, $data);
  }
  
}