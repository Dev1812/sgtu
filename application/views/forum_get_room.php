<div id="forum">
<script type="text/javascript" src="/js/upload.js?1"></script>
  <div id="forum_messages">

    <div id="write_msg_layer" onMouseDown="scroller('forums');">
      <span class="write_msg_layer_link">Написать сообщение</span>
    </div>
<?php
  if(!$data['forum']['html'] && !is_array($data['forum']['html'])) {
    echo '<div class="obj_not_found posts_no_found">'.$i18n['posts_not_found'].'</div>';
  } else {
    foreach($data['forum']['html'] as $v) {
      for($i=0;$i<7;$i++){
?>
<div class="user_block" id="msg_<?=$v['id'];?>">
  <img class="user_photo float_left" src="<?=$v['small_photo'];?>" alt="<?=$v['owner_initials'];?>">
  <div class="user_block_wrap">
    <a href="/id<?=$v['owner_id'];?>">
      <?=$v['owner_initials'];?>
    </a>
    <div class="forum_msg_text user_block_body">
      <?=$v['text'];?>
    </div>

    <div class="forum_msg_info">
      <span class="forum_date">
        <?=$v['date'];?>
      </span>
      <span class="forum_divider">·</span>
      <span class="forum_author_link">Ответить</span>
    </div> 
  </div>
</div> 
<?php 
      } 
    }
  }
?>
  </div>


  <div id="write_msg_block">
    <div class="icon_attach" onClick="ge('attach_img').click();"></div>
    <div class="upload_photo">
      <input class="file" id="attach_img" type="file" size="28" onchange="Forum.uploadPhotos(this.files);" multiple="true" accept="image/jpeg,image/png,image/gif" name="photo">
    </div>
    <input type="hidden" id="form_hash" name="form_hash" value="<?=$data['csrf_token'];?>">
    <TEXTAREA id="msg" placeholder="Ваше сообщение" class="text_field textarea" style="height:57px;resize:none;"></TEXTAREA>

    <div id="msg_img_preview">
      <!--<img src="/images/upload.gif">-->
    </div>
      <input type="submit" onClick="Forum.submitForm();" value="Отправить" class="submit button" style="color:#0084ff;background:transparent;text-transform:uppercase;font-size:13px;padding:0 3px;">
  </div>



<?php
  if($data['forum']['has_more'] === true){
?>
    <div id="load_more" class="load_more" onClick="Forum.getMoreMessages();">
      <span id="load_more_text"><?=$i18n['load_more'];?></span>
      <div id="load_more_upload" class="icon_upload"></div>
    </div>
<?php
  }
?>
</div>