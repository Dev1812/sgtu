<?php

  if( empty($data['ajax']['html']) && !is_array($data['ajax']['html']) ) {
	  echo json_encode(array('err'=>false,'has_more'=>false,'html'=>'','offset'=>$data['ajax']['offset']));
	  exit;
  }

  $html = '';

  foreach($data['ajax']['html'] as $v) {
    $html .='<div class="post" id="post_'.$v['id'].'">
      <img class="author_photo float_left" src="/images/no_photo.png" alt="'.$v['owner_name'].'">

      <div class="post_wrap">
        <div class="post_info">
          <a class="author_name">'.$v['owner_name'].'</a>
          <span class="questbook_divider">·</span>
          <span class="questbook_date">'.$v['date'].'</span>
        </div>

      	<div class="post_text">'.$v['text'].'</div>
      </div>
    </div>';
  }
  
  echo json_encode(array('err'=>false,'has_more'=>$data['ajax']['has_more'],'offset'=>$data['ajax']['offset'],'html'=>$html));
  exit;

?>