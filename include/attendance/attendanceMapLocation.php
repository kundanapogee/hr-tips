<!-- 

<div class="modal" id="attendanceEmpMapLocation<?php echo $id; ?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php if(isset($attendance_date)){ echo $attendance_date; } ?> <smal class="text-danger">(<?php if(isset($dayName)){ echo $dayName; } ?>)</small></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">            
            <div class="textBox">
                <p class="mb-1"><strong>Entry Position:</strong></p>
                <p class="mb-1"><?php if (isset($entry_time)) { echo  $entry_time; } ?></p>
                <div>
                  <div id="map<?php echo $id; ?>"  style="border: 2px solid #3872ac;height: 300px;"></div>
                  <div id="directions_panel<?php echo $id; ?>"></div>
                </div>
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Position:</strong></p>
                <p class="mb-1"><?php if (isset($exit_time)) { echo  $exit_time; } ?></p>
                <!-- <div>
                  <div id="map<?php echo $id; ?>"  style="border: 2px solid #3872ac;height: 300px;"></div>
                  <div id="directions_panel<?php echo $id; ?>"></div>
                </div> -->
            </div>
          </div>


<?php
echo $entry_latitude;
echo "<br>";
echo $entry_longitude;
?>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>

  // var entryLatitude = "<?php echo $entry_latitude; ?>";
  // var entryLongitude = "<?php echo $entry_longitude; ?>";

  // alert(entryLatitude+" "+entryLongitude);

var MapPoints = '[{"address":{"lat":"<?php echo $office_latitude; ?>","lng":"<?php echo $office_longitude; ?>"}},{"address":{"lat":"<?php echo $entry_latitude;?>","lng":"<?php echo $entry_longitude; ?>"}}]';

// console.log(MapPoints);

// alert(MapPoints);

// mihir
// var MapPoints = '[{"address":{"lat":"28.619686","lng":"77.3807433"}},{"address":{"lat":"28.579519","lng":"77.439529"}}]';

// Patna
// var MapPoints = '[{"address":{"lat":"28.619686","lng":"77.3807433"}},{"address":{"lat":"25.611219","lng":"85.130692"}}]';

var MY_MAPTYPE_ID = 'custom_style';
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });

  if (jQuery('#map<?php echo $id; ?>').length > 0) {

    var locations = jQuery.parseJSON(MapPoints);

    map = new google.maps.Map(document.getElementById('map<?php echo $id; ?>'), {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false
    });
    directionsDisplay.setMap(map);

    var infowindow = new google.maps.InfoWindow();
    var flightPlanCoordinates = [];
    var bounds = new google.maps.LatLngBounds();

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
        map: map
      });
      flightPlanCoordinates.push(marker.getPosition());
      bounds.extend(marker.position);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i]['title']);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

    map.fitBounds(bounds);

    // directions service configuration
    var start = flightPlanCoordinates[0];
    var end = flightPlanCoordinates[flightPlanCoordinates.length - 1];
    var waypts = [];
    for (var i = 1; i < flightPlanCoordinates.length - 1; i++) {
      waypts.push({
        location: flightPlanCoordinates[i],
        stopover: true
      });
    }
    calcRoute(start, end, waypts);
  }
}

function calcRoute(start, end, waypts) {
  var request = {
    origin: start,
    destination: end,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions_panel<?php echo $id; ?>');
      // summaryPanel.innerHTML = '';
      // // For each route, display summary information.
      // for (var i = 0; i < route.legs.length; i++) {
      //   var routeSegment = i + 1;
      //   summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
      //   summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
      //   summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
      //   summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      // }
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>




 -->