var PopupBox = {
  onKeyUp:function(e) {
    if(e.keyCode == KeyCode.ESC) {
      PopupBox.hide();  
    }
  },
  showFrom: function(url) {
    if(!url) return false;
    ajax.post({
      url: url,
      success: function(obj) {
        if(obj.param) {
          PopupBox.setOptions(obj.param);
        }
        PopupBox.show(obj.title, obj.body, obj.control || '');
      }
    });
  },
  setOptions:function(param) {
    param = param || {};
    if(param.css) {
      ge('pb_wrap').style = param.css;
    }
  },
  show: function(title,body,controls,param) {
    ge('pb_title').innerHTML = title;
    ge('pb_body').innerHTML = body;
    if(controls) {
      ge('pb_controls').innerHTML = body;  
    } else {
      hide('pb_controls'); 
    }
    show(['pb', 'layer_background']);
    addEvent(document, 'keyup', PopupBox.onKeyUp);
  },
  hide: function() {
    hide(['pb', 'layer_background']);
    removeEvent(document, 'keyup', PopupBox.onKeyUp);
  }
}