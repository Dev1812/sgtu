<?php
  $u = $data['profile'];
  $initials = $u['first_name'].' '.$u['last_name'];
  $no_photo = '/images/no_photo.png';
  $photo = (!empty($info['small_photo'])) ? 'onClick="showPhoto(1, {big_photo:'.$u['big_photo'].'});"' : '';
  $small_photo = (!empty($u['small_photo'])) ? $u['small_photo'] : $no_photo;
?>
<div id="profile_<?=$u['id'];?>" class="profile">
  <div class="profile_info_block">
    <img class="big_photo" src="<?=$small_photo;?>" alt="<?=$initials;?>" <?=$photo;?>>
    <div class="profile_info">
      <div class="user_name"><?=$initials;?></div>
      <div class="">
        <div class="info_key"><?=$i18n['date_birth'];?>:</div>
        <span class="info_value"><?=strtolower($u['date_birth']);?></span>
      </div>
      <div class="">
        <div class="info_key"><?=$i18n['university'];?>:</div>
        <span class="info_value">СГТУ</span>
      </div>
      <div class="">
        <div class="info_key"><?=$i18n['direction'];?>:</div>
        <span class="info_value">МФПИТ</span>
      </div>
      <div class="">
        <div class="info_key"><?=$i18n['group'];?>:</div>
        <span class="info_value">ИФСТ-12</span>
      </div>
    </div> 
  </div>
</div>