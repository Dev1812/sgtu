var map = {};
var KeyCode = {
  LEFT: 37,
  UP: 38,
  RIGHT: 39,
  DOWN: 40,
  DEL: 8,
  TAB: 9,
  RETURN: 13,
  ENTER: 13,
  ESC: 27,
  PAGEUP: 33,
  PAGEDOWN: 34,
  SPACE: 32,
  CTRL: 17,
  ALT: 18,
  F: 70,
  P: 80
};
function updateCaptcha(img_id){
  if(!img_id) return false;
  ge(img_id).src = '/captcha#'+rand(0,1000);
}
function rand(min, max) {
  max = max || 1260;
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
function showTopError(text) {
  var top_error = ge('top_error');
  top_error.innerHTML = text;
  show(top_error);
  setTimeout(function(){hide(top_error)},19*1000);
}
function isArray(el) {
  return Array.isArray(el);
}
function showFormMsg(message, form_id){
  var form = ge(form_id);
  form.innerHTML = message;
  show(form);
}
function checkEvent(e) {
  return (e.type=='click' || e.type=='mousedown' || e.type=='mouseup') ? true : false;
}
function addEvent(el, event_type, handler) {
  el = ge(el);
  if(el.addEventListener) {
    el.addEventListener(event_type, handler, false);
  } else if(el.attachEvent) {
    el.attachEvent('on'+event_type, handler);
  } else {
    el['on'+event_type] = handler;
  }
}
function removeEvent(el, event_type, handler) {
  var el = ge(el);
  if(el.removeEventListener) {     
    el.removeEventListener(event_type, handler);
  } else if(el.detachEvent) {
    el.detachEvent('on'+eventType, handler);
  }
}
function setHeadActiveLink(link_id) {
  if(!link_id) return false;
  addClass(link_id, 'head_active_link');
}
function getTopScroll() {
  return window.pageYOffset||document.documentElement.scrollTop;
}


// DOM
function ge(id){
  return (typeof id=='string'||typeof id=='number') ? document.getElementById(id) : id;
}
function hasClass(el, class_name) {
  el = ge(el);
  if(window.classList && classList.contains) {
    return el.classList.contains(class_name);
  }
  return el.class_name && new RegExp("(^|\\s)" + class_name + "(\\s|$)").test(el.class_name);
}
function toggle(id) {
  var el = ge(id), old_display;
  if(!el) return false;
  old_display = getStyle(el, 'display');
  if(old_display == 'none') {
    show(el);
  } else if(old_display == 'block') {
    hide(el);
  }
}
function show(el) {
  if(isArray(el)) {
    for(var i in el) {
       show(el[i]);
    }
    return false;
  }
  var el = ge(el),
      tag,
      new_display = 'block';
  if(!el) return false;
  tag = el.tagName.toLowerCase();
  if(tag == 'tr') {
    new_display = 'table-row';
  } else if(tag == 'table') {
    new_display = 'table';
  } else if(tag == 'a' || tag == 'span') {
    new_display = 'inline';
  }
  el.style.display = new_display;
}
function hide(el){
  if(isArray(el)) {
    for(var i in el) {
       hide(el[i]);
    }
    return false;
  }
  ge(el).style.display='none';
}
function addClass(el, class_name) {
  el = ge(el);
  if(window.classList && classList.add) {
    return el.classList.add(class_name);
  }
  var re = new RegExp('(^|\\s)' + class_name + '(\\s|$)', 'g');
  if (re.test(el.className)) return;
  el.className = (el.className + ' ' + class_name).replace(/\s+/g, ' ').replace(/(^ | $)/g, '');
}
function removeClass(id, class_name){
  el = ge(el);
  if(window.classList && classList.remove) {
    return el.classList.remove(class_name);
  }
  if(!el) return false;
  var re = new RegExp('(^|\\s)' + class_name + '(\\s|$)', 'g');
  el.className = el.className.replace(re, '$1').replace(/\s+/g, ' ').replace(/(^ | $)/g, '');
}
function nextEl(el) {
  el = el.nextSibling;
  while (el && !el.tagName) el = el['nextSibling'];
  return el;
}
function prevEl(el) {
  el = el.previousSibling;
  while (el && !el.tagName) el = el['previousSibling'];
  return el;
}
function getStyle(el,styleProp) {
  var el = ge(el);
  if(!el) return false;
  return el.currentStyle ? el.currentStyle[styleProp] : document.defaultView.getComputedStyle(el,null).getPropertyValue(styleProp);
}
// END DOM


function parseJSON(obj){
  if(window.JSON && JSON.parse) {
    return JSON.parse(obj);
  }
  return eval('('+obj+')');
}
function log(t) {
  if(window.console && console.log) {
    console.log(t);
  }
}
var ajax = {
  init: function() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch(e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch(e) {
        xhr = false;
      }
    }
    if(!xhr && typeof XMLHttpRequest!='undefined') {
      xhr = new XMLHttpRequest();
    }
    return xhr;  
  },
  request: function(param) {
    var r = ajax.init(), method = param.method || 'POST';
    r.open(method, param.url, true);
    r.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    r.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    r.send(param.data);
    if(param.showProgress) {
      param.showProgress();
    }
    r.onreadystatechange = function() {
      if(r.readyState == 4) {
        if(r.status >= 200 && r.status < 300) {
          var response = parseJSON(r.responseText);
          if(response.js) {
            ajax.pasteJs(response.js);
          }
          if(param.success) {
            param.success(response);
          }
        }      
        if(param.hideProgress) {
          param.hideProgress();
        }
      }
    };  
    return r;
  },
  post: function(param) {
    return ajax.request({
      url: param.url,
      data: param.data,
      method: 'POST',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  get: function(param) {
    return ajax.request({
      url: param.url,
      method: 'GET',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  pasteJs: function(js) {
    if(!js) return false;
    var code = document.createElement('script');
    code.type = 'text/javascript';
    code.innerHTML = js;
    document.head.appendChild(code);
  }
}