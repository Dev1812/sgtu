<?php
$arr = array('title' => $i18n['auth'],
             'body' => '<div class="form" style="padding:17px 0;">
<FORM name="login" action="" method="POST" onSubmit="PopupBox.loginSubmit();event.preventDefault();">
  <div class="form_msg" id="pb_login_msg"></div>
  <div class="form_text" id="pb_login_text">'.$i18n['login_text'].'</div>
        <div class="input_wrap">
          <input type="hidden" name="pb_form_hash" id="pb_form_hash" value="'.$data['form_hash'].'">
          <input type="text" name="email" id="pb_email" class="text_field" placeholder="'.$i18n['your_email'].'" autofocus></div>
        <div class="input_wrap">
          <input type="text" name="password" id="pb_password" class="text_field" placeholder="'.$i18n['your_password'].'">
        </div>
        <div class="input_wrap">
          <input type="submit" name="login" class="submit button" value="'.$i18n['login'].'">
          <a href="/restore" class="float_right" style="margin:7px 0;">'.$i18n['forgot_password'].'</a>
        </div>
      </FORM>
    </div>
  </div>','js'=>'PopupBox.loginSubmit = function(){
                   var email = ge("pb_email"), password = ge("pb_password"), email_val = email.value, password_val = password.value, form_hash = ge("pb_form_hash").value;
                   if(email_val.length < 5) {
                     return email.focus();
                   } else if(password_val.length < 4) {
                     return password.focus();
                   }
                   hide("pb_login_text");
                   ajax.post({
                     url: "/login/a_submit",
                     data: "email="+email_val+"&password="+password_val+"&form_hash="+form_hash,
                     success: function(obj) {
                       switch(obj.err) {
                         case true:
                           if (obj.err_msg) {
                             showErrorForm(obj.err_msg, "pb_login_msg");
                           }
                           break;
                         case false:
                           if(obj.url) {
                             var meta = document.createElement("meta");
                             meta.httpEquiv="refresh";
                             content = "1;URL="+obj.url;
                             document.head.appendChild(meta);
                           }
                           break;
                       }
                     }
                   });
                 }');
echo json_encode($arr);
?>