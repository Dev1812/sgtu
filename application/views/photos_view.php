<div id="photos">  
  <div class="photos_title">Новый Год</div>
  <?php
    $p = $data['photos'];
    $h = $p['html'];
    if(empty($h) || !is_array($h)) {
      echo '<div class="obj_not_found">'.$i18n['posts_not_found'].'</div>';
    } else {
      foreach ($h as $v) {
  ?>
  <div class="photo_wrap" id="photo_<?=$v['id'];?>" onClick="showPhoto(<?=$v['album_id'];?>_<?=$v['id'];?>, {big_photo:'<?=$v['photo_path'];?>'});">
    <img class="photo" alt="<?=$v['owner_initials'];?>" src="<?=$v['photo_path'];?>">
  </div>
  <?php
      }
    }
  ?>

</div>