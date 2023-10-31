<?php

include 'header.php';

// $is_active = 'active';
$empID = $_GET['emp_id'];

$query = $conn->prepare("SELECT * From employee where id=:empID order by id desc");
$query->bindParam(':empID',$empID);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);
$employeeResultTitle = $employeeResult[0]['title'];
$employeeResultName = $employeeResult[0]['full_name'];
$employeeResultFullName = $employeeResultTitle." ".$employeeResultName;

$query = $conn->prepare("SELECT id, employee_id,entry_time,entry_distance,attendance_date,attendance_status from daily_attendance where employee_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);



$query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$lunchTakenResult = $query->fetchAll();
$lunchTakenRow = count($lunchTakenResult);



$query = $conn->prepare("SELECT * from employee_leave where emp_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empLeaveAppliedResult = $query->fetchAll();
$empLeaveAppliedRow = count($empLeaveAppliedResult);



?> 

<style>
    .fc-title{
        text-transform: capitalize;
    }
</style>

<link href="assets/libs/%40fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/%40fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/%40fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/%40fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><?php if(isset($employeeResultFullName)){ echo $employeeResultFullName; } ?></h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Employee Detail</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">                               
                                <div class="row">   
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                  <h5 class="font-size-16 me-3">Lunch Calender</h5>
                                                  <div class="ms-auto">
                                                     <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                                  </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div id="lunchCalender"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                  <h5 class="font-size-16 me-3">Attendance Calender</h5>
                                                  <div class="ms-auto">
                                                     <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                                  </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div id="attendanceCalender"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap">
                                                  <h5 class="font-size-16 me-3">Leave Calender</h5>
                                                  <div class="ms-auto">
                                                     <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                                  </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div id="leaveCalender"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div> 


                            <div style='clear:both'></div>

                                





                            </div>
                        </div>

                       






<?php
include 'footer.php';
?> 
   
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="assets/libs/%40fullcalendar/core/main.min.js"></script>
<script src="assets/libs/%40fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/%40fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/%40fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/%40fullcalendar/interaction/main.min.js"></script>


<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>





   

<script>
    !(function (g) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        var l = g("#event-modal"),
            t = g("#modal-title"),
            a = g("#form-event"),
            i = null,
            r = null,
            s = document.getElementsByClassName("needs-validation"),
            i = null,
            r = null,
            e = new Date(),
            n = e.getDate(),       
            d = e.getMonth(),
            o = e.getFullYear();       
        var c = [            
                <?php 
                    if(isset($lunchTakenRow)){
                      if ($lunchTakenRow>0){
                        foreach ($lunchTakenResult as $value) {
                          $lunch_date = $value['lunch_date'];
                          ?>
                          {title: 'Taken', start: '<?php echo $lunch_date; ?>', end: '<?php echo $lunch_date; ?>', className: "bg-success" },
                          <?php
                        }
                      }
                    }
                ?>
            ],


        v = (document.getElementById("lunchCalender"));     
        var m = new FullCalendar.Calendar(v, {
            plugins: ["bootstrap", "interaction", "dayGrid"],
            // plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
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




<script>
    !(function (g) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        var l = g("#event-modal"),
            t = g("#modal-title"),
            a = g("#form-event"),
            i = null,
            r = null,
            s = document.getElementsByClassName("needs-validation"),
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
                          $attendance_date = $value['attendance_date'];
                          $entry_time = $value['entry_time'];
                          $entry_distance = $value['entry_distance']; 
                          $attendance_status = $value['attendance_status']; 
                          ?>
                          {title: '<?php echo $attendance_status; ?>', start: '<?php echo $attendance_date; ?>', end: '<?php echo $attendance_date; ?>', className: "bg-success" },
                          <?php
                        }
                      }
                    }
                ?>
            ],


        v = (document.getElementById("attendanceCalender"));     
        var m = new FullCalendar.Calendar(v, {
            // plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            plugins: ["bootstrap", "interaction", "dayGrid"],
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




<script>
    !(function (g) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        var l = g("#event-modal"),
            t = g("#modal-title"),
            a = g("#form-event"),
            i = null,
            r = null,
            s = document.getElementsByClassName("needs-validation"),
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
            ],


        v = (document.getElementById("leaveCalender"));     
        var m = new FullCalendar.Calendar(v, {
            // plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            plugins: ["bootstrap", "interaction", "dayGrid"],
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















