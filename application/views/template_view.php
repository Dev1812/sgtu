<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="/images/icons/favicon.ico">
  <title><?=$param['title'];?></title>
  <link rel="stylesheet" type="text/css" href="/css/common.css?1">
  <script type="text/javascript" src="/js/common.js?1"></script>
  <?php
    if(!empty($param['css']) && is_array($param['css'])) {
      foreach ($param['css'] as $v) {
        echo '<link rel="stylesheet" type="text/css" href="/css/'.$v.'.css">';
      }
    }
    if(!empty($param['js']) && is_array($param['js'])) {
      foreach ($param['js'] as $v) {
        echo '<script type="text/javascript" src="/js/'.$v.'.js"></script>';
      }
    } 
  ?>
</head>
<body>
<div id="wrap1">
  <div id="back_to_top" onClick="backToTop();">
    <img class="back_to_top_icon" src="/images/back_to_top.png">
    Наверх
  </div>
  <div id="top_error"></div>
  <div class="head" id="head">
    <a href="/" class="head_link">
	  <span class="logo">Сгту</span>
	</a>
    <div class="fl_r">
      <a href="/forum" class="head_link">Форум</a>
      <a href="/albums" class="head_link">Альбомы</a>
      <a href="/questbook" class="head_link">Гостевая книга</a>
      <?php
        if(!empty($_SESSION['user_id'])) {
          echo '<a href="/logout" class="head_link">Выйти</a>';
        } else {
      ?>
        <a href="/login" class="head_link" onClick="Head.showLoginForm(event);">Войти</a>
      <?php
        }
      ?>
    </div>
  </div>

  <div class="content">
    <?php
      include 'application/views/'.$content_view;
    ?>
  </div>  


  <div class="layer_background" id="layer_background"></div>

  <!-- Popup Box -->
  <div class="pb layer" id="pb">
    <div class="pb_background_close" onClick="PopupBox.hide();">
      <img src="/images/close.svg" width="21px" height="21px" alt="close">
    </div>
    <div class="pb_wrap" id="pb_wrap">
      <div class="pb_title_wrap">
        <div class="pb_close fl_r" onClick="PopupBox.hide();"></div>
        <div id="pb_title" class="pb_title"></div>
      </div>
      <div id="pb_body" class="pb_body"></div>
      <div id="pb_controls" class="pb_controls"></div>
    </div>
  </div>

  <!-- Photo Layer -->
  <div id="pl" class="layer">
    <div class="pl_close" onClick="PhotoLayer.hide();"></div>
    <div class="pl_wrap">
      <div id="pl_arrow_left" class="pl_arrow pl_arrow_left" onClick="PhotoLayer.show(map.pl_active_photo-1);">
        <div class="pl_arrow_left_icon"></div>
      </div>
      <div id="pl_arrow_right" class="pl_arrow pl_arrow_right" onClick="PhotoLayer.show(map.pl_active_photo+1);">
        <div class="pl_arrow_left_icon"></div>
      </div>
      <img id="pl_image" class="pl_image" src="/images/sgtu_photo.jpg">
    </div>
  </div>

  <div class="clear"></div>   
 
  <div class="footer">
    <a class="footer_link" href="/about">О cайте</a>
    <a class="footer_link" href="/support">Помощь</a>
    <a class="footer_link" href="/contacts">Контакты</a>
    <div>Sgtu &copy; <?=date('Y');?></div>
  </div>
</div>
</body>
</html>