<div id="login">
  <div class="form form_login">
    <FORM name="login" action="/login/submit/" method="POST">
      <div class="form_title">Авторизация</div>
      <?php
        if($data['login']['err'] === true) {
          echo '<div class="form_msg" id="login_msg" style="display: block;">'.$data['login']['err_msg'].'</div>';
        } else echo '<div class="form_text" id="login_text">'.$i18n['login_text'].'</div>';
      ?>
      <div class="input_wrap">
        <input type="hidden" name="form_hash" id="form_hash" value="<?=$data['form_hash'];?>">
        <input type="text" name="email" class="text_field" placeholder="<?=$i18n['your_email'];?>" autofocus>
      </div>
      <div class="input_wrap">
        <input type="text" name="password" class="text_field" placeholder="<?=$i18n['your_password'];?>">
      </div>
      <div class="input_wrap">
        <input type="submit" name="login" class="submit button" value="<?=$i18n['login'];?>">
        <a href="/restore" class="float_right" style="margin:7px 0;"><?=$i18n['forgot_password'];?></a>
      </div>
    </FORM>
  </div>
</div>