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
                //initialize();
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
        
        
        <script>
            var locations = {};//A repository for markers (and the data from which they were contructed).

            //initial dataset for markers
            var locs = {
                1: {info: '11111. Some random info here', lat: -37.8139, lng: 144.9634},
                2: {info: '22222. Some random info here', lat: 46.0553, lng: 14.5144},
                3: {info: '33333. Some random info here', lat: -33.7333, lng: 151.0833},
                4: {info: 'tehnn', lat: 27.9798, lng: -81.731}
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 2,
                maxZoom: 8,
                minZoom: 1,
                streetViewControl: false,
                center: new google.maps.LatLng(40, 0),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();

            var auto_remove = true;//When true, markers for all unreported locs will be removed.

            function setMarkers(locObj) {
                if (auto_remove) {
                    //Remove markers for all unreported locs, and the corrsponding locations entry.
                    $.each(locations, function(key) {
                        if (!locObj[key]) {
                            if (locations[key].marker) {
                                locations[key].marker.setMap(null);
                            }
                            delete locations[key];
                        }
                    });
                }

                $.each(locObj, function(key, loc) {
                    if (!locations[key] && loc.lat !== undefined && loc.lng !== undefined) {
                        //Marker has not yet been made (and there's enough data to create one).

                        //Create marker
                        loc.marker = new google.maps.Marker({
                            position: new google.maps.LatLng(loc.lat, loc.lng),
                            map: map
                        });

                        //Attach click listener to marker
                        google.maps.event.addListener(loc.marker, 'click', (function(key) {
                            return function() {
                                if (locations[key]) {
                                    infowindow.setContent(locations[key].info);
                                    infowindow.open(map, locations[key].marker);
                                }
                            }
                        })(key));

                        //Remember loc in the `locations` so its info can be displayed and so its marker can be deleted.
                        locations[key] = loc;
                    }
                    else if (locations[key] && loc.remove) {
                        //Remove marker from map
                        if (locations[key].marker) {
                            locations[key].marker.setMap(null);
                        }
                        //Remove element from `locations`
                        delete locations[key];
                    }
                    else if (locations[key]) {
                        //Update the previous data object with the latest data.
                        $.extend(locations[key], loc);
                        if (loc.lat !== undefined && loc.lng !== undefined) {
                            //Update marker position (maybe not necessary but doesn't hurt).
                            locations[key].marker.setPosition(
                                    new google.maps.LatLng(loc.lat, loc.lng)
                                    );
                        }
                        //locations[key].info looks after itself.
                    }
                });
            }

            var ajaxObj = {//Object to save cluttering the namespace.
                options: {
                    url: "getcars.php", //The resource that delivers loc data.
                    dataType: "json"//The type of data tp be returned by the server.
                },
                delay: 2000, //(milliseconds) the interval between successive gets.
                errorCount: 0, //running total of ajax errors.
                errorThreshold: 5, //the number of ajax errors beyond which the get cycle should cease.
                ticker: null, //setTimeout reference - allows the get cycle to be cancelled with clearTimeout(ajaxObj.ticker);
                get: function() { //a function which initiates 
                    if (ajaxObj.errorCount < ajaxObj.errorThreshold) {
                        ajaxObj.ticker = setTimeout(getCarsData, ajaxObj.delay);
                    }
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    ajaxObj.errorCount++;
                }
            };

            //Ajax master routine
            function getCarsData() {
                $.ajax(ajaxObj.options)
                        .done(setMarkers) //fires when ajax returns successfully
                        .fail(ajaxObj.fail) //fires when an ajax error occurs
                        .always(ajaxObj.get); //fires after ajax success or ajax error
            }

            //setMarkers(locs);//Create markers from the initial dataset served with the document.
            ajaxObj.get();//Start the get cycle.


        </script>
        
    </body>
</html>