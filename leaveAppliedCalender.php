<?php
  include 'header.php';
  include 'profileHeader.php';

$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from employee_leave where emp_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empLeaveAppliedResult = $query->fetchAll();
$empLeaveAppliedRow = count($empLeaveAppliedResult);


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
                    if(isset($empLeaveAppliedRow)){
                      if ($empLeaveAppliedRow>0){
                        foreach ($empLeaveAppliedResult as $value) {
                          $from_date = $value['from_date'];
                          $to_date = $value['to_date'];
                          $leave_type_id = $value['leave_type_id'];
                          $is_approved = $value['is_approved'];
                          $reason = substr($value['reason'],0, 70);

                          if ($is_approved=='pending'){
                            $className = "bg-warning";
                          }if ($is_approved=='approve'){
                            $className = "bg-success";
                          }if ($is_approved=='disapprove'){
                            $className = "bg-danger";
                          }


                          $to_date=date_create($value['to_date']);
                                date_add($to_date,date_interval_create_from_date_string("1 days"));
                          $to_date_after = date_format($to_date,"Y-m-d");

                        $query = $conn->prepare("SELECT short_name from leave_type where id = :leave_type_id order by id desc");
                        $query->bindParam(':leave_type_id',$leave_type_id);
                        $query->execute();
                        $empLeaveAppliedResult = $query->fetchAll();
                        $empLeaveAppliedRow = count($empLeaveAppliedResult);
                        if ($empLeaveAppliedRow>0) {
                            $empLeaveSrtName = $empLeaveAppliedResult[0]['short_name'];
                            // $reason = "(".$empLeaveSrtName.")"." ".$reason;
                            $reason = "(".$empLeaveSrtName.")";
                        }

                          ?>
                          { title: '<?php echo $reason; ?>', start: '<?php echo $from_date; ?>', end: '<?php echo $to_date_after; ?>', className: '<?php echo $className; ?>' },
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