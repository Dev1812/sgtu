<?php
class Controller_Forum extends Controller {
    
  public $security;
  public $i18n;
  public $view;
  public $model;

  public function __construct() {
    $this->security = new Security;
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Forum;
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('forum','posts_not_found','load_more'));
    $param['css'] = array('forum');
    $param['js'] = array('forum');
    $param['title'] = $i18n['forum'];
    $data['forum'] = $this->model->getQuestions();
    $this->view->generate('forum_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_get() {
    $i18n = $this->i18n->get(array('forum','posts_not_found','load_more'));
    $param['css'] = array('forum');
    $param['js'] = array('forum');
    $param['title'] = $i18n['forum'];
    $data['forum'] = $this->model->getRoomMessages($_GET['question_id']);
    $data['csrf_token'] = $this->security->getCSRFToken();
    $this->view->generate('forum_get_room.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_add_msg() {
    $v = array('id'=>1,'small_photo'=>'/images/282C8FAE00000578-0-image-a-13_1430473872685.jpg','owner_name'=>'rewr ewrew','text'=>'ghjgh','date_created'=>'6 авг в 11:47');
    $arr = array('err'=>false,'html'=>'
<div class="user_block" id="msg_'.$v['id'].'">
  <img class="user_photo float_left" src="'.$v['small_photo'].'" alt="'.$v['owner_name'].'">
  <div class="user_block_wrap">
    <a href="/id'.$v['owner_id'].'">
      '.$v['owner_name'].'
    </a>
    <div class="user_block_body">
      '.$v['text'].'
    </div>

    <div class="forum_msg_info">
      <span class="forum_date">
        '.$v['date_created'].'
      </span>
      <span class="forum_divider">·</span>
      <span class="forum_author_link">Ответить</span>
    </div> 
  </div>
</div> ');
    echo json_encode($arr);
  }

}