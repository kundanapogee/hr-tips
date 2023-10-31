<?php
  include 'header.php';
  include 'profileHeader.php';

$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from events order by id desc");
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);


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
                    if(isset($empDailyAttRow)){
                      if ($empDailyAttRow>0){
                        foreach ($empDailyAttResult as $value) {
                          $event_name = $value['event_name'];
                          $start_date = $value['start_date'];
                          $end_date = $value['end_date'];
                          $classname = $value['classname'];

                          $end_date=date_create($value['end_date']);
                                date_add($end_date,date_interval_create_from_date_string("1 days"));
                          $end_date_after = date_format($end_date,"Y-m-d");


                          ?>
                          {title: '<?php echo $event_name; ?>', start: '<?php echo $start_date; ?>', end: '<?php echo $end_date_after; ?>', className: '<?php echo $classname; ?>' },
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