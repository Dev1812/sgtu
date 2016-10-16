var _secrect_map_key = "AIzaSyBmUML2egImMQTMd_WFwDifvaxa_o9uOo0";

function mapInit() {
  var school_gps = new google.maps.LatLng(51.2467013,51.4188301),
      mapCanvas = document.getElementById('map'),
      mapOptions = {
        center: new google.maps.LatLng(51.2467013, 51.4188301),
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      },
      map = new google.maps.Map(mapCanvas, mapOptions),
      marker = new google.maps.Marker({  
        position: school_gps,   
        map: map,     
        draggable: false, 
        title: "Школа 9"
      });       
  map.setCenter(school_gps);   
}
setTimeout(function(){google.maps.event.addDomListener(window, 'load', mapInit);},10);
