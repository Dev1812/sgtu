var News = {
  
}

window.addEventListener("scroll", function(e){
  if((document.body.scrollTop || document.documentElement.scrollTop) >= document.body.offsetHeight - window.innerHeight){
    console.log('ok');
    hide('load_more_text');
    show('load_more_upload');
  }
})