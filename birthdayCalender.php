<?php
  include 'header.php';
  include 'profileHeader.php';

//   $today_date = date('Y-m-d'); 

// $empID = $_SESSION['empIDSESS'];
// $query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID order by id desc");
// $query->bindParam(':employeeID',$empID);
// $query->execute();
// $lunchTakenResult = $query->fetchAll();
// $lunchTakenRow = count($lunchTakenResult);


$is_active = "active";
$today_date = date('Y-m-d');
$query = $conn->prepare("SELECT id,full_name,title,dob From employee where is_active = :is_active ");
$query->bindParam(':is_active',$is_active);
$query->execute();
$empBirthDayListResult = $query->fetchAll();
$empBirthDayListRow = count($empBirthDayListResult);


// echo "<pre>";
// print_r($empBirthDayListResult[0]['dob']);

// echo "<br>";

// echo $dateMonth = substr($empBirthDayListResult[0]['dob'],4,10);

// echo "<br>";

// echo $currentYear = date("Y");

// echo "<br>";

// echo $birthdayWithCurrentYear = $currentYear."".$dateMonth;

// echo "</pre>";

?>

<link href="assets/calender/css/core/main.min.css" rel="stylesheet" type="text/css" />
<link href="assets/calender/css/daygrid/main.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="assets/calender/css/bootstrap/main.min.css" rel="stylesheet" type="text/css" /> -->
<link href="assets/calender/css/timegrid/main.min.css" rel="stylesheet" type="text/css" />
<link href="assets/calender/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="assets/calender/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/calender/css/app.min.css" rel="stylesheet" type="text/css" />



            

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>




<?php
  include 'footer.php';
?>

<script src="assets/calender/js/core/main.min.js"></script>
<script src="assets/calender/js/bootstrap/main.min.js"></script>
<script src="assets/calender/js/daygrid/main.min.js"></script>
<script src="assets/calender/js/timegrid/main.min.js"></script>
<script src="assets/calender/js/interaction/main.min.js"></script>


<script>
    !(function (g) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        var i = null,
            r = null,
            i = null,
            r = null,
            e = new Date(),
            n = e.getDate(),       
            d = e.getMonth(),
            o = e.getFullYear();
        var c = [            
                <?php 
                    if(isset($empBirthDayListRow)){
                      if ($empBirthDayListRow>0){
                        foreach ($empBirthDayListResult as $value) {
                          $title = $value['title'];
                          $full_name = $value['full_name'];
                          $dob = $value['dob'];
                          $dateMonth = substr($dob,4,10);
                          $currentYear = date("Y");
                          $birthdayWithCurrentYear = $currentYear."".$dateMonth;
                          ?>
                          {title: '<?php echo $full_name; ?>', start: '<?php echo $birthdayWithCurrentYear; ?>', end: '<?php echo $birthdayWithCurrentYear; ?>', className: "bg-success" },
                          <?php
                        }
                      }
                    }
                ?>
                // { title: "All Day Event", start: new Date(o, d, 2) },
                // { title: "Long Event", start: new Date(o, d, n - 5), end: new Date(o, d, n - 2), className: "bg-warning" },
                // { id: 999, title: "Repeating Event", start: new Date(o, d, n - 3, 16, 0), allDay: !1, className: "bg-info" },
                // { id: 999, title: "Repeating Event", start: new Date(o, d, n + 4, 16, 0), allDay: !1, className: "bg-primary" },
                // { title: "Meeting", start: new Date(o, d, n, 10, 30), allDay: !1, className: "bg-success" },
                // { title: "Lunch", start: new Date(o, d, n, 12, 0), end: new Date(o, d, n, 14, 0), allDay: !1, className: "bg-danger" },
                // { title: "Birthday Party", start: new Date(o, d, n + 1, 19, 0), end: new Date(o, d, n + 1, 22, 30), allDay: !1, className: "bg-success" },

                // { title: "kundan Click for Google", start: new Date("2023-03-25"), end: new Date("2023-03-26"), url: "http://google.com/", className: "bg-dark" },
            ],


            v = (document.getElementById("calendar"));     
        var m = new FullCalendar.Calendar(v, {
            plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            editable: 0,
            droppable: !0,
            selectable: !0,
            defaultView: "dayGridMonth",
            themeSystem: "bootstrap",
            header: { left: "prev,next today", center: "title", right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth" },
            events: c,
        });
        m.render()
    }),
        (g.CalendarPage = new e()),
        (g.CalendarPage.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.CalendarPage.init();
    })();

</script>