<div class="news">
<?php
  if(empty($data['news']['title']) && empty($data['news']['id'])) {
    echo '<div class="obj_not_found news_not_found">'.$i18n['news_not_found'].'</div>';
  } elseif($data['err'] === true) {
    if(!empty($data['err_msg'])) {
      echo '<div class="obj_not_found news_not_found">'.$data['err_msg'].'</div>';
    }
  } else {
    $v = $data['news'];
?>
  <div class="news_block" id="news_<?=$v['id'];?>">
    <div class="news_title"><?=$v['title'];?></div>
    <div class="news_info">
       <a class="news_info_link" href="/id<?=$v['owner_id'];?>"><?=$v['owner_initials'];?></a>
       <span class="news_info_link" class="news_divider">·</span>
       <span class="news_info_link"><?=$v['date'];?></span>
    </div>
    <div class="news_text">
      <?=$v['text'];?>
    </div>
  </div>
<?php
  }
?>
</div>