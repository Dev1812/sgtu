var Questbook = {
  onWindowScroll: function(e) {
    var scroll_top = document.body.scrollTop || document.documentElement.scrollTop;
    if( scroll_top >= document.body.offsetHeight - window.innerHeight ){
      Questbook.getMore();
    }
  },
  send: function(el, event) {
    var name = ge('name'),
        name_val = name.value,
        message = ge('message'),
        message_val = message.value,
        captcha_code = ge('captcha_code'),
        captcha_code_val = captcha_code.value,
        msg = ge('questbook_form_msg');
    if(name_val.length < 2) {
      return name.focus();
    } else if(message_val.length < 2) {
      return message.focus();
    } else if(captcha_code_val.length < 2) {
      return captcha_code.focus();
    }
    hide(msg);
    ajax.post({
      url: '/questbook/a_send',
      data: 'name='+name_val+'&message='+message_val+'&captcha_code='+captcha_code_val+'&form_hash='+ge('form_hash').value,
      success: function(obj) {
        switch(obj.err) {
          case true:
            msg.innerHTML = obj.err_msg;
            show(msg);
            break;
          case false:
            var questbook_msg = ge('questbook_msg');
            var html = document.createElement('div');
            html.innerHTML = obj.html;
            questbook_msg.insertBefore(html, questbook_msg.firstChild);
            break;
        }
      }
    });
  },
  getMore: function() {
    addEvent(window, 'scroll', Questbook.onWindowScroll);
    ajax.post({
      url: '/questbook/a_get_more/?offset='+encodeURIComponent(ge('questbook_offset').value),
      showProgress: function() {
        hide('load_more_text');
        show('load_more_upload');
      },
      hideProgress: function() {
        show('load_more_text');
        hide('load_more_upload');
      },
      success: function(obj) {
        switch(obj.err) {
          case true:
            break;
          case false:
            if(obj.has_more === false) {
              hide('load_more');
            }
            if(obj.offset) {
              ge('questbook_offset').value = obj.offset;
            }

            var html = document.createElement('div');
            html.innerHTML = obj.html;
            ge('questbook_msg').appendChild(html);
            break;
        }
      }
    });
  }
}