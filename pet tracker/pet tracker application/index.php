<?php
include_once 'header.php';
?>

<div class="container">
    <div id="main">
        <div class="body-container">
            
            <?php
                if(isset($_SESSION["useruid"])){
                    // if user logged in
                    echo "<h1>Pet Location</h1>
                    <div id='map'></div>

                        <script async src='https://maps.googleapis.com/maps/api/js?key=GoogleMapsKeyHere&callback=loadmaps'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script>

      var map;
        var x;
        function loadmaps(){
            $.getJSON('https://api.thingspeak.com/channels/2000931/fields/1/last.json?api_key=ApiKeyHere', function(result){
        	
            var m = result;
            x=Number(m.field1);
                           //alert(x);

        });
            $.getJSON('https://api.thingspeak.com/channels/2000931/fields/2/last.json?api_key=ApiKeyHere', function(result){
        	
            var m = result;
            y=Number(m.field2);
                
                
        }).done(function() {
            
                initialize();
    });
            
        }
        window.setInterval(function(){
        loadmaps();
            }, 15000);
      function initialize() {
          //alert(y);
        var mapOptions = {
          zoom: 18,
          center: {lng: x, lat: y}
        };
        map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

        var marker = new google.maps.Marker({
          position: {lng: x, lat: y},
          map: map,
          icon: {
            url: 'img/dogMarker.png',
            size: new google.maps.Size(48, 48),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(24, 24),
            scaledSize: new google.maps.Size(48, 48)
          }
        });

        var infowindow = new google.maps.InfoWindow({
          content: '<p>Marker Location:' + marker.getPosition() + '</p>'
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>";
                }
                else{
                    // if user not logged in
                    echo "<h1>Sign in to track pet</h1>
                    <div id='map'></div>

                        <script>
                            async function initMap() {
                            var location = {lat: 54.378, lng: -2};
                            var map = new google.maps.Map(document.getElementById('map'),{
                                zoom: 4,
                                center: location
                            });
                        }
    
    
                        </script>
                        <script async src='https://maps.googleapis.com/maps/api/js?key=GoogleMapsKeyHere&callback=initMap'></script>";
                }
            ?>
            
        
    </div>
</div>
</div>
                
<?php
include_once 'footer.php';
?>
