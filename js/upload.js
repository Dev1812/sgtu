var Upload = {
  upload_url: '/upload.php',
  init: function() {

  },
  getFileName: function(file){
    return (file[0].fileName || file[0].name || '').replace(/[&<>"']/g, '');
  },
  uploadFiles: function(files, opts) {
     if(!files) return false;
     opts = opts || {};
     for(var i in files) {
       Upload._uploadFile(files[i], i, opts)
     }
  },
  _uploadFile: function(file, i, opts) {

    if(!window.FormData) {
        return false; 
    }

    var form = new FormData(), file_name = Uploader.getFileName(file), xhr = new XMLHttpRequest();
    form.append(file_name, file);
    if(opts.onUploadStart) {
      opts.onUploadStart(file_name, i);
    }

    xhr.open('POST', this.upload_url, true);

    xhr.onload = function(e) {
      if(opts.onUploadComplete) {
        opts.onUploadComplete(e.target.responseText);
      }
    };
    xhr.onerror = function(e) {
      if(opts.onUploadError) {
        opts.onUploadError(e);
      }
    };
    xhr.upload.onprogress = function(e) {
      if(opts.onUploadProgress) {
        opts.onUploadProgress(i, e.loaded, e.total);
      }
    };
    xhr.send(form);
  }
  
}