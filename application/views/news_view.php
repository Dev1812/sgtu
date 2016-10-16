<div class="news">
<?php
  if(!$data['news']['html'] && !is_array($data['news']['html'])) {
    echo '<div class="obj_not_found news_not_found">'.$i18n['news_not_found'].'</div>';
  } else {
    foreach($data['news']['html'] as $v) {
?>
  <div class="news_block" id="news_<?=$v['id'];?>">
    <div class="news_title">
      <a class="news_title_link" href="/news/get/?news_id=<?=$v['id'];?>">
        <?=$v['title'];?>
      </a>
    </div>
    <div class="news_info">
       <a class="news_info_link" href="/id<?=$v['owner_id'];?>"><?=$v['owner_initials'];?></a>
       <span class="news_divider">·</span>
       <a class="news_info_link"><?=$v['date'];?></a>
    </div>
    <div class="news_text">
      <?=$v['text'];?>
    </div>
  </div>
<?php
    }
  }

  if($news['has_more'] === true){
?>
    <div id="load_more" class="load_more" onClick="News.getMore(this, event);">
      <span id="load_more_text"><?=$i18n['load_more'];?></span>
      <div id="load_more_upload" class="icon_upload"></div>
    </div>
<?php
  }
?>
</div>