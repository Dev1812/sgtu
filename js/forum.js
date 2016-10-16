var Forum = {
  _uploaded_photos: {},
  uploadPhotos: function(files) {
    if(!files) return false;

      Upload.uploadFiles(files, {
        upload_url: '/upload/upload/?from=forum',
        onUploadStart: function(file_name, i){
          log(i);
          var html = document.createElement('div');
          html.className = 'photo_upload_preview';
          html.id = 'photo_upload_preview_'+i;

          html.innerHTML = '\
            <div class="photo_upload_progress_wrap">\
              <div class="photo_upload_progress" id="photo_upload_progress_'+i+'"></div>\
            </div>\
            <span class="photo_upload_file_name">'+file_name+'</span>\
            <span class="photo_upload_close" onClick="Upload.unchooseMedia(this, event, '+i+');"></span>';

          ge('msg_img_preview').appendChild(html);

        },
        onUploadProgress: function(i, loaded, total){
          loaded = parseInt((total / loaded) * 100);
          ge('photo_upload_progress_'+i).style.width=loaded+'%';
        },
        onUploadComplete: function(response){
          log(response);
        }
      });
  },
  submitForm: function(el, event) {
    var msg = ge('msg'),
        msg_value = msg.value,
        media = Forum.getMedias(), 
        form_hash = ge('form_hash').value;
    if(msg_value.length < 2) {
      return msg.focus();
    }
    ajax.post({
      url: '/forum/add_msg/?ajax=true',
      data: 'msg='+encodeURIComponent(msg_value)+'&form_hash='+encodeURIComponent(form_hash),
      success: function(data) {
        if(data.err === false) {
          if(data.html) {
            var html = document.createElement('div');
            html.innerHTML = data.html;
            ge('forum_messages').appendChild(html);
          }
        }
      }
    });

  },
  getMedias: function() {}
}