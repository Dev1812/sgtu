<div class="albums">
  <?php
    $a = $data['albums'];
    $h = $a['html'];
    if(empty($h) || !is_array($h)) {
      echo '<div class="obj_not_found">'.$i18n['posts_not_found'].'</div>';
    } else {
      foreach ($h as $v) {
  ?>
  <div id="album_<?=$v['id'];?>" class="album_block">
    <a href="/albums/get_photos/?album_id=<?=$v['id'];?>" class="album_wrap">
      <img class="album_cover" src="<?=$v['cover'];?>">
      <div class="album_title"><?=$v['title'];?></div>
    </a>
  </div>
  <?php
      }
    }
  ?>
</div>