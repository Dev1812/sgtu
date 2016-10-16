<div class="welcome_main">
  <div class="welcome_layer"></div>
  <div class="welcome_desc">
    <div class="welcome_desc_title"><?=$i18n['welcome_title'];?></div>
    <div class="welcome_desc_text"><?=$i18n['welcome_text'];?></div>
  </div>
</div>

<div class="wide_column_news">
  <div class="narrow_column_wrap news_column_wrap">
  <?php
    if(empty($data['news']['html']) && !is_array($data['news']['html'])) {
      echo '<div class="obj_not_found">'.$i18n['news_not_found'].'</div>';
    } else {
      foreach($data['news']['html'] as $v) {
  ?>
    <div class="news" id="news<?=$v['id'];?>">
      <div class="news_title">
        <a href="/news/get/?news_id=<?=$v['id'];?>"><?=$v['title'];?></a>
      </div>
      <div class="news_info">
        <span class="news_date"><?=$v['date'];?></span>
        <span class="news_divider">·</span>
        <a class="news_owner"><?=$v['owner_initials'];?></a>
      </div>
      <div class="news_text">
        <?=$v['text'];?>
        <div class="news_read_more">
          <a href="/news/get/?news_id=<?=$v['id'];?>"><?=$i18n['read_more'];?></a>
        </div>
      </div>
    </div>
  <?php
      }//foreach 
    }
  ?>
  </div>
  <div class="wide_column_wrap events_column_wrap">
    <div class="events_column_title">События</div>
    <div id="events_upload" class="upload_icon"></div>

    <div id="events_wrap">
     <?php
    for($i=0;$i<7;$i++){
  ?>
    <div class="event">
      <div class="event_date">21 мар</div>
      <div class="event_title"><a>Цифровой ветер-2016</a></div>
    </div>
    <?php
  }
    ?>
    </div>
  </div>
</div>