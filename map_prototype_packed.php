<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="lib/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" href="themes/mytheme.css" />
        <script src="lib/jquery-1.9.1.min.js" ></script>
        <script src="lib/jquery.mobile-1.3.2.min.js" ></script>
        <style type="text/css">
            .labels {
                color: red;
                background-color: white;
                font-family: "Lucida Grande", "Arial", sans-serif;
                font-size: 10px;
                font-weight: bold;                
                text-align: center;
                border: 1px solid #3c3c3c;
                white-space: nowrap;
            }
        </style>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&language=th"></script>
        <script type="text/javascript" src="lib/markerwithlabel.js"></script>
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
            }

            $(document).on('pageshow', '#page-map', function(e, data) {
                $('#content').height(getRealContentHeight());
                
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
            var locations = {};


            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 4,
                streetViewControl: false,
                center: new google.maps.LatLng(16, 100),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();

            var auto_remove = true;

            function setMarkers(locObj) {
                if (auto_remove) {
                   
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
                    
                        var icon_img;
                        if (loc.type == 'a') {
                            icon_img = 'mapicon/a.png';
                        }
                        if (loc.type == 'b') {
                            icon_img = 'mapicon/b.png';
                        }
                        if (loc.type == 'c') {
                            icon_img = 'mapicon/c.png';
                        }

                        loc.marker = new MarkerWithLabel({
                            position: new google.maps.LatLng(loc.lat, loc.lng),
                            icon:icon_img,
                           
                            map: map,
                            labelContent: loc.info,
                            labelAnchor: new google.maps.Point(15, 0),
                            labelClass: "labels", 
                            labelStyle: {opacity: 1.0}
                        });

                       
                        google.maps.event.addListener(loc.marker, 'click', (function(key) {
                            return function() {
                                if (locations[key]) {
                                    infowindow.setContent(locations[key].info);
                                    infowindow.open(map, locations[key].marker);
                                }
                            }
                        })(key));

                       
                        locations[key] = loc;
                    }
                    else if (locations[key] && loc.remove) {
                       
                        if (locations[key].marker) {
                            locations[key].marker.setMap(null);
                        }
                        
                        delete locations[key];
                    }
                    else if (locations[key]) {
                        
                        $.extend(locations[key], loc);
                        if (loc.lat !== undefined && loc.lng !== undefined) {
                            
                            locations[key].marker.setPosition(
                                    new google.maps.LatLng(loc.lat, loc.lng)
                                    );
                        }
                       
                    }
                });
            }

            var ajaxObj = {
                options: {
                    url: "getcars.php",
                    dataType: "json"
                },
                delay: 2000, 
                errorCount: 0, 
                errorThreshold: 5, 
                ticker: null, 
                get: function() { 
                    if (ajaxObj.errorCount < ajaxObj.errorThreshold) {
                        ajaxObj.ticker = setTimeout(getCarsData, ajaxObj.delay);
                    }
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    ajaxObj.errorCount++;
                }
            };

        
            function getCarsData() {
                $.ajax(ajaxObj.options)
                        .done(setMarkers) 
                        .fail(ajaxObj.fail) 
                        .always(ajaxObj.get); 
            }

            
            ajaxObj.get();

        </script>

    </body>
</html>