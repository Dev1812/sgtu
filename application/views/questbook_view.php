<div class="questbook">

  <div class="questbook_block write_message_block">
    <div class="questbook_title"><?=$i18n['create_note'];?></div>
    <div class="form_msg" id="questbook_form_msg"></div>
    <FORM action="" method="POST" onSubmit="Questbook.send(this, event);event.preventDefault();"> 
      <div class="input_wrap">
        <input type="hidden" name="form_hash" id="form_hash" value="<?=$data['form_hash'];?>">
        <input type="text" class="text_field" name="name" id="name" placeholder="<?=$i18n['your_name'];?>" autofocus>
      </div>
      <div class="input_wrap">
        <TEXTAREA class="text_field textarea" name="message" id="message" placeholder="<?=$i18n['your_message'];?>"></TEXTAREA>
       </div>
      <div class="input_wrap">
        <input type="text" id="captcha_code" class="text_field" maxlength="7" style="width:150px;" name="name" id="name" placeholder="<?=$i18n['captcha_code'];?>">

        <span style="position:absolute;margin-left:29px;">
          <img src="/captcha" id="captcha_img" style="cursor:pointer;" onClick="updateCaptcha();">
        </span>
      </div>

      <div class="input_wrap">
        <input type="submit" class="quetbook_button" value="<?=$i18n['send'];?>">
      </div>
    </FORM> 
  </div>

  <div class="questbook_block">
  	<div class="questbook_title posts_title"><?=$i18n['notes'];?></div>
    <div id="questbook_msg">
      <input type="hidden" name="questbook_offset" id="questbook_offset" value="20">
<?php
  foreach($data['questbok_msg'] as $v) {
?>
    <div class="post" id="post_<?=$v['id'];?>">
      <img class="author_photo float_left" src="/images/no_photo.png" alt="<?=$v['owner_name'];?>">

      <div class="post_wrap">
        <div class="post_info">
          <a class="author_name"><?=$v['owner_name'];?></a>
        </div>

      	<div class="post_text"><?=$v['text'];?>
          <BR><span class="questbook_date"><?=$v['date'];?></span>
      	</div>
      </div>
    </div>
<?php
}
?>
    </div>
    <div class="load_more" id="load_more" onClick="Questbook.getMore();">
      <div id="load_more_text" class=""><?=$i18n['load_more'];?></div>
      <img id="load_more_upload" style="display:none;margin:0 auto;" src="/images/upload.gif">
    </div>
  </div>

</div>