
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOT5yBi-LAmh9P2X0jQmm4y7zOUaWRXI0&sensor=false"></script> -->

<?php

// $address = 'Noida';
// $apiKey = 'AIzaSyDOT5yBi-LAmh9P2X0jQmm4y7zOUaWRXI0';

// $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $apiKey;
// $data = json_decode(file_get_contents($url));

// $lat = $data->results[0]->geometry->location->lat;
// $lng = $data->results[0]->geometry->location->lng;



// echo $lat;
// echo "<br>";
// echo $lng;


?>




 <div id="result"></div>
   <script>
      let result = document.getElementById("result");
      let userLocation = navigator.geolocation;
         if(userLocation) {
            userLocation.getCurrentPosition(success);
         } else {
            "The geolocation API is not supported by your browser.";
         }
      function success(data) {
         let lat = data.coords.latitude;
         let long = data.coords.longitude;
         result.innerHTML = "Latitude: "
         + lat
         + "<br>Longitude: "
         + long;
      }
   </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>