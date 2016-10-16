<?php
class Controller_Albums extends Controller {

  public $i18n;
  public $view;
  public $security;
  public $model;

  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Albums;
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('albums','posts_not_found'));
    $param['css'] = array('albums');
    $param['title'] = $i18n['albums'];
    $data['albums'] = $this->model->getAlbums();
    $this->view->generate('albums_view.php', 'template_view.php', $param, $data, $i18n);
  }
  public function action_get_photos() {
    $i18n = $this->i18n->get(array('photos','posts_not_found'));
    $param['css'] = array('albums');
    $param['js'] = array('albums');
    $param['title'] = $i18n['photos'];
    $data['photos'] = $this->model->getPhotos($_GET['album_id'], $_GET['offset']);
    $this->view->generate('albums_photos_view.php', 'template_view.php', $param, $data);
  }
}