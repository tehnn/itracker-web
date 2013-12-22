<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title>MarkerWithLabel Example</title>
 <style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;
     border: 2px solid black;
     white-space: nowrap;
   }
 </style>
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false"></script>
 <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.9/src/markerwithlabel.js"></script>
 <script type="text/javascript">
   function initMap() {
     var latLng = new google.maps.LatLng(49.47805, -123.84716);
     var homeLatLng = new google.maps.LatLng(49.47805, -123.84716);

     var map = new google.maps.Map(document.getElementById('map_canvas'), {
       zoom: 12,
       center: latLng,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     var marker1 = new MarkerWithLabel({
       position: homeLatLng,
       draggable: true,
       raiseOnDrag: true,
       map: map,
       labelContent: "$425K",
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 0.75},
       icon: {}
     });

     var marker2 = new MarkerWithLabel({
       position: new google.maps.LatLng(49.475, -123.84),
       draggable: true,
       raiseOnDrag: true,
       map: map,
       labelContent: "$395K",
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 1.0}
     });

     var iw1 = new google.maps.InfoWindow({
       content: "Home For Sale"
     });
     var iw2 = new google.maps.InfoWindow({
       content: "Another Home For Sale"
     });
     google.maps.event.addListener(marker1, "click", function (e) { iw1.open(map, this); });
     google.maps.event.addListener(marker2, "click", function (e) { iw2.open(map, this); });
   }
 </script>
</head>
<body onload="initMap()">

 <div id="map_canvas" style="height: 400px; width: 100%;"></div>

</body>
</html>