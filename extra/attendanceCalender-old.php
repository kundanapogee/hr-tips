<?php
  include 'header.php';
  include 'profileHeader.php';

$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);


?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css">

<style>

#calendar {
  max-width: 1100px;
  margin: 40px auto;
}
.fc-h-event{
  background-color: #226e09;
  border: 1px solid #226e09;
}
</style>

  <body>
    

    <div id='calendar'></div>


<?php
  include 'footer.php';
?>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>


<script>
 document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var fullDate = new Date()
  var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
  var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
  // console.log(currentDate);

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: currentDate,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: [

      <?php 
        if(isset($empDailyAttRow)){
          if ($empDailyAttRow>0){
            foreach ($empDailyAttResult as $value) {
              $attendance_date = $value['attendance_date'];
              ?>
              {title: 'Present', start: '<?php echo $attendance_date; ?>', end: '<?php echo $attendance_date; ?>'},
              <?php
            }
          }
        }
      ?>
      // {
      //   groupId:'999', 
      //   title: 'All Day Event',
      //   start: '2023-03-01',
      //   end: '2023-03-10',
      //   url: 'http://google.com/',
      //   classname: 'danger'
      // },      
    ]
  });

  calendar.render();
});
</script>

  </body>
</html>


<!-- https://codepen.io/camerongoddard/pen/PopqzVZ -->