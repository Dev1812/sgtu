var PhotoLayer = {
  active_photo_id:0,
  photos: {},
  updatePhotos: function(class_name) {
    class_name = class_name || 'pv_photo';
    var photos = gc(class_name), photos_length = photos.length;
    for(var i = 0; i < photos_length; i++) {
      if(!photos[i].getAttribute('data-pl')) {
        //photos.
      }
    }
  },
  show: function(photo_id, param) {
    param = param || {};
    ge('pl_image').src = param.big_photo;
    show(['pl', 'layer_background']);
    addEvent(document, 'keyup', PopupBox.onKeyUp);
  },
  hide: function() {
    hide(['pl','layer_background']);
  }
}