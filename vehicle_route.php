<?php
session_start();
if (empty($_SESSION['user'])) {
    //echo "Not permission!!!";
    //exit;
}
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="lib/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" href="themes/mytheme.css" />
        <script src="lib/jquery-1.9.1.min.js" ></script>
        <script src="lib/jquery.mobile-1.3.2.min.js" ></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=TH"></script>  

        <style>
            #content {
                padding: 0 !important;
            }
        </style>
        <script>
            var map;
            function initialize() {
                var mapOptions = {
                    zoom: 6,
                    center: new google.maps.LatLng(16, 100),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map-canvas'),
                        mapOptions);

                addPin(16, 100, "กก22พล\r\n<?= date('Y-m-d H:i:s') ?>");
                addPin(14.345, 99.99833, "I am here2.");

                

            }// end initialize

            function addPin(lat, lng, text) {
                var infowindow = new google.maps.InfoWindow({
                    content: text
                });

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    map: map,
                    title: text


                });
                google.maps.event.addListener(marker, 'click', function() {
                    //infowindow.open(map, marker);
                });

            }//end Addpin


            function getRealContentHeight() {
                var header = $.mobile.activePage.find("div[data-role='header']:visible");
                var footer = $.mobile.activePage.find("div[data-role='footer']:visible");
                var content = $.mobile.activePage.find("div[data-role='content']:visible:visible");
                var viewport_height = $(window).height();

                var content_height = viewport_height - header.outerHeight() - footer.outerHeight();
                if ((content.outerHeight() - header.outerHeight() - footer.outerHeight()) <= viewport_height) {
                    content_height -= (content.outerHeight() - content.height());
                }
                return content_height;
            }// end setHeigth



            $(document).on('pageshow', '#page-map', function(e, data) {
                $('#content').height(getRealContentHeight());
                initialize();
            });
        </script>
    </head>
    <body>
        <div data-role="page" id="page-map" >
            <div  data-role="header" data-position="fixed" data-theme="f">
                <a href="#" data-icon="bars">Menu</a>
                <h1>iTracker Location Monitor</h1>
            </div>

            <div data-role="content" id="content">
                <div id="map-canvas" style="height:100%"></div>
            </div>

            <div data-role="footer" data-position="fixed" data-theme="f" >
                <h4>Copy Right 2013 - 2015</h4>
            </div>
        </div>
    </body>
</html>