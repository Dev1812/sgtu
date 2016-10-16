<div id="forum">
<?php
  if(!$data['forum']['html'] && !is_array($data['forum']['html'])) {
    echo '<div class="obj_not_found posts_no_found">'.$i18n['posts_not_found'].'</div>';
  } else {
    foreach($data['forum']['html'] as $v) {
?>
  <div class="forum_block" id="forum_<?=$v['id'];?>">
    <div class="forum_title">
      <a class="forum_title_link" href="/forum/get/?question_id=<?=$v['id'];?>">
        <?=$v['title'];?>
      </a>
    </div>
    <div class="forum_info">
       <a class="forum_info_link" href="/id<?=$v['owner_id'];?>"><?=$v['owner_initials'];?></a>
       <span class="forum_divider">·</span>
       <a class="forum_info_link"><?=$v['date'];?></a>
    </div>
    <div class="forum_text">
      <?=$v['text'];?>
    </div>
  </div>
<?php  
    }
  }
  if($data['forum']['has_more'] === true){
?>
    <div id="load_more" class="load_more" onClick="Forum.getMoreQuestions();">
      <span id="load_more_text"><?=$i18n['load_more'];?></span>
      <div id="load_more_upload" class="icon_upload"></div>
    </div>
<?php
  }
?>
</div>