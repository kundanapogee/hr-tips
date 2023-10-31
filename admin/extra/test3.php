<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        width: 600px;
       }
    </style>
  </head>
  <body>
    <!--The div elements for the map and message -->
    <div id="map"></div>
    <div id="msg"></div>
    <script>
        var map;
        function initMap()           {
          const center = {lat: 28.619686, lng: 77.3807433};
          const options = {zoom: 15, scaleControl: true, center: center};
          map = new google.maps.Map(
              document.getElementById('map'), options);
          // Locations of landmarks
          const office = {lat: 28.619686, lng: 77.3807433};
          const employee = {lat: 28.579519, lng: 77.439529};
          // The markers for The office and The employee Collection
          var mk1 = new google.maps.Marker({position: office, map: map});
          var mk2 = new google.maps.Marker({position: employee, map: map});
        }
    </script>
    <!--Load the API from the specified URL -- remember to replace YOUR_API_KEY-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOT5yBi-LAmh9P2X0jQmm4y7zOUaWRXI0&callback=initMap">
    </script>
  </body>
</html>