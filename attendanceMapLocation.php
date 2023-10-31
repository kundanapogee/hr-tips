<?php
if ((isset($_GET['id'])) && (!empty($_GET['id'])))  {
  $id = $_GET['id'];
}else{
 die();
}

include 'header.php';
include 'profileHeader.php';

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT id,entry_time,exit_time,entry_latitude,entry_longitude,entry_distance,exit_latitude,exit_longitude,exit_distance from daily_attendance where id = :dailyAttID");
$query->bindParam(':dailyAttID',$id);
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);
 if ($empDailyAttRow>0) {
    foreach ($empDailyAttResult as $value) {
        $entry_time = $value['entry_time'];
        $exit_time = $value['exit_time'];
        $entry_latitude = $value['entry_latitude'];
        $entry_longitude = $value['entry_longitude'];
        $entry_distance = $value['entry_distance'];
        $exit_latitude = $value['exit_latitude'];
        $exit_longitude = $value['exit_longitude'];
        $exit_distance = $value['exit_distance'];
    }
}

$office_code = 'noida';
$query = $conn->prepare("SELECT * from office_detail where office_code = :office_code order by id desc");
$query->bindParam(':office_code',$office_code);
$query->execute();
$officeCodeResult = $query->fetchAll();
$officeCodeRow = count($officeCodeResult);
if(isset($officeCodeRow)) {
   if ($officeCodeRow>0) {
       foreach ($officeCodeResult as $value) {
          $office_latitude = $value['latitude'];
          $office_longitude = $value['longitude'];
       }
   }
}
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOT5yBi-LAmh9P2X0jQmm4y7zOUaWRXI0"></script>

<section class="commonBox sectionPadding pt-md-4">
  <div class="container">
    <!-- <div class="row">
      <div class="col-md-6">
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelApplyLeave" class="btn btn-success waves-effect waves-light btn-sm">Apply Leave <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
      <div class="col-md-6 text-end">
        <a href="attendanceCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">View Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
    </div> -->

    <div class="row mt-4">

      <div class="col-md-6 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Entry Detail</h3>
          </div> 
          <hr>
          <div>
            <div class="textBox">
                <p class="mb-1"><?php if (isset($entry_time)) { echo  $entry_time; } ?></p>
                <div>
                  <div id="entryMap"  style="border: 2px solid #3872ac;height: 300px;"></div>
                  <div id="entryDirections_panel"></div>
                </div>
            </div>
          </div>
        </div>        
      </div>


      <?php
        if (!empty($exit_time)) {
          ?>
            <div class="col-md-6 col-12 mb-4">
                <div class="box">
                  <div class="">
                    <h3 class="fw-bold">Exit Detail</h3>
                  </div> 
                  <hr>
                  <div>
                    <div class="textBox">
                        <p class="mb-1"><?php if (isset($exit_time)) { echo  $exit_time; } ?></p>
                        <div>
                          <div id="exitMap"  style="border: 2px solid #3872ac;height: 300px;"></div>
                          <div id="exitDirections_panel"></div>
                        </div>
                    </div>
                  </div>
                </div>        
              </div>
          <?php
        }
      ?>
      







    </div>
  </div>
</section>





<?php
  include 'footer.php';
?>


<script>
var MapPoints = '[{"address":{"lat":"<?php echo $office_latitude; ?>","lng":"<?php echo $office_longitude; ?>"}},{"address":{"lat":"<?php echo $entry_latitude;?>","lng":"<?php echo $entry_longitude; ?>"}}]';

var MY_MAPTYPE_ID = 'custom_style';
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });

  if (jQuery('#entryMap').length > 0) {
    var locations = jQuery.parseJSON(MapPoints);
    map = new google.maps.Map(document.getElementById('entryMap'), {
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
      response.routes[0];
      document.getElementById('entryDirections_panel');
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>


















<script>
var MapPointsExit2 = '[{"address":{"lat":"<?php echo $office_latitude; ?>","lng":"<?php echo $office_longitude; ?>"}},{"address":{"lat":"<?php echo $exit_latitude;?>","lng":"<?php echo $exit_longitude; ?>"}}]';
var MY_MAPTYPE_IDExit2 = 'custom_style1';
var directionsDisplayExit2;
var directionsServiceExit2 = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplayExit2 = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });
  if (jQuery('#exitMap').length > 0) {
    var locations = jQuery.parseJSON(MapPointsExit2);
    map = new google.maps.Map(document.getElementById('exitMap'), {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false
    });
    directionsDisplayExit2.setMap(map);
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
  directionsServiceExit2.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplayExit2.setDirections(response);
      response.routes[0];

      console.log(response.routes[0]);
      document.getElementById('exitDirections_panel');
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>



