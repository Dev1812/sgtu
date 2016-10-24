<div id="reg">
  <div class="form form_reg">
    <FORM name="reg" action="/reg" method="POST">
      <div class="form_title"><?=$i18n['reg'];?></div>
      <?php
        if($data['reg']['err'] === true) {
          echo '<div class="form_msg" id="reg_msg" style="display: block;">'.$data['reg']['err_msg'].'</div>';
        } else echo '<div class="form_text" id="login_text">'.$i18n['reg_text'].'</div>';
      ?>
      <div class="input_wrap">
        <input type="hidden" name="form_hash" value="<?=$data['form_hash'];?>">
        <input type="text" name="firstname" class="text_field" placeholder="<?=$i18n['your_name'];?>" autofocus>
      </div>
      <div class="input_wrap">
        <input type="text" name="lastname" class="text_field" placeholder="<?=$i18n['your_lastname'];?>">
      </div>
      <div class="input_wrap">
        <input type="text" name="email" class="text_field" placeholder="<?=$i18n['your_email'];?>">
      </div>
      <div class="input_wrap">
        <input type="text" name="password" class="text_field" placeholder="<?=$i18n['your_password'];?>">
      </div>
      <div class="input_wrap">
        <input type="submit" class="submit" name="reg_submit" value="<?=$i18n['register'];?>">
      </div>
    </FORM>
  </div>
</div>