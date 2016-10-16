<div id="restore">
  <div class="form form_restore">
    <FORM name="restore" action="/restore/submit/" method="POST">
      <div class="form_title"><?=$i18n['restore'];?></div>
      <?php
        if($data['restore']['err'] === true) {
          echo '<div class="form_msg" id="restore_msg" style="display: block;">'.$data['restore']['err_msg'].'</div>';
        } else echo '<div class="form_text" id="restore_text">'.$i18n['restore_text'].'</div>';
      ?>
      <div class="input_wrap">
        <input type="hidden" name="form_hash" value="<?=$data['form_hash'];?>">
        <input type="text" name="email" class="text_field" placeholder="<?=$i18n['your_email'];?>" autofocus>
      </div>
      <div class="input_wrap">
        <input type="submit" class="submit" name="restore" value="<?=$i18n['send'];?>">
      </div>
    </FORM>
  </div>
</div>