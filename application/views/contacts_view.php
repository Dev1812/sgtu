<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmUML2egImMQTMd_WFwDifvaxa_o9uOo0" type="text/javascript"></script>
<script type="text/javascript">
function mapInit() {
  var gps = new google.maps.LatLng(51.5292983,45.9798099),
      mapCanvas = document.getElementById('map'),
      mapOptions = {
        center: new google.maps.LatLng(51.5292983,45.9798099),
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      },
      map = new google.maps.Map(mapCanvas, mapOptions),
      marker = new google.maps.Marker({  
        position: gps,   
        map: map,     
        draggable: false, 
        title: "СГТУ"
      });       
  map.setCenter(gps);   
}
google.maps.event.addDomListener(window, 'load', mapInit);
</script>
<div class="contacts">
  <div class="contacts_block">
    <div class="contacts_title">Контакты</div>
    <div class="contacts_wrap">
      <div>
        <span class="info_title">Адрес:</span>
        <span class="info_value">город Саратов, улица Политехническая, 77</span>
      </div>
      <div>
        <span class="info_title">Общий отдел:</span>
        <span class="info_value">(8452) 99-86-03</span>
      </div>
      <div>
        <span class="info_title">Приемная ректора:</span>
        <span class="info_value">(8452) 99-88-11, 99-88-22 </span>
      </div>
      <div>
        <span class="info_title">Телефон приёмной комисссии:</span>
        <span class="info_value">(8452) 99-86-65</span>
      </div>
    </div>
  </div>

  <div class="contacts_block">
    <div class="contacts_title map_title">
      Карта
    </div>
    <div class="contacts_wrap">
      <div id="map"></div>
    </div>
  </div>
</div>