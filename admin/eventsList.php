<?php

include 'header.php';


// $is_active = 'active';
$query = $conn->prepare("SELECT * From events");
$query->execute();
$eventResult = $query->fetchAll();
$eventRow = count($eventResult);

// $query = $conn->prepare("SELECT * From religion ");
// $query->execute();
// $religionResult = $query->fetchAll();
// $religionRow = count($religionResult);

?> 

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
                                    <h4 class="mb-sm-0 font-size-18">Events List</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Holidays & Other</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                               
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-grid">
                                                    <!-- <button class="btn font-16 btn-primary" id="myModalAddEvent"><i class="mdi mdi-plus-circle-outline"></i> Create New Event</button> -->

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#myModalAddEvent" class="btn font-16 btn-primary" title="Add New Event">Create New Event</a>

                                                </div>
                                            
                                               
                                                
                                                <div id="external-events" class="mt-2">
                                                    <br>
                                                    <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                                    <div class="external-event fc-event bg-success" data-class="bg-success">
                                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event Planning
                                                    </div>
                                                    <div class="external-event fc-event bg-info" data-class="bg-info">
                                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                                                    </div>
                                                    <div class="external-event fc-event bg-warning" data-class="bg-warning">
                                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating Reports
                                                    </div>
                                                    <div class="external-event fc-event bg-danger" data-class="bg-danger">
                                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create New theme
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center mt-5">
                                                    <img src="assets/images/verification-img.png" alt="" class="img-fluid d-block">
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-->

                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> 


                            <div style='clear:both'></div>

                                


<div id="myModalAddEvent" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="custom-validation" action="backend/eventsAdd.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Event Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">                                       
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Event Name</label>
                                <input type="text" class="form-control" name="event_name"
                                placeholder="Event Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                placeholder="Start Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date"
                                placeholder="End Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Class Name</label>
                                <select class="form-control form-select" name="classname" required>
                                    <option  selected disabled> --Select-- </option>
                                    <option value="bg-danger">Danger</option>
                                    <option value="bg-success">Success</option>
                                    <option value="bg-primary">Primary</option>
                                    <option value="bg-secondry">Secondry</option>
                                    <option value="bg-info">Info</option>
                                    <option value="bg-dark">Dark</option>
                                    <option value="bg-warning">Warning</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="submitFormBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                <!-- Add New Event MODAL -->
                                <!-- <div class="modal fade" id="event-modal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header py-3 px-4 border-bottom-0">
                                                <h5 class="modal-title" id="modal-title">Event</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Event Name</label>
                                                                <input class="form-control" placeholder="Insert Event Name"
                                                                    type="text" name="title" id="event-title" required value="" />
                                                                <div class="invalid-feedback">Please provide a valid event name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Category</label>
                                                                <select class="form-control form-select" name="category" id="event-category">
                                                                    <option  selected> --Select-- </option>
                                                                    <option value="bg-danger">Danger</option>
                                                                    <option value="bg-success">Success</option>
                                                                    <option value="bg-primary">Primary</option>
                                                                    <option value="bg-info">Info</option>
                                                                    <option value="bg-dark">Dark</option>
                                                                    <option value="bg-warning">Warning</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please select a valid event category</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-6">
                                                            <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- end modal-->

                            </div>
                        </div>

                       
<?php

// echo "<pre>";

// print_r($eventResult);
// ?>

 <?php
//                     if (isset($eventRow)) {
//                         if ($eventRow>0) {
//                             foreach ($eventResult as $value) {
//                                 $event_id = $value['id'];
//                                 $event_name = $value['event_name'];
//                                 $start_date = $value['start_date'];
//                                 $end_date = $value['end_date'];
//                                 ?>
<!-- //                                 { id: <?php echo  $event_id  ?>, title: "<?php echo  $event_name  ?>", start: new Date("<?php echo  $start_date  ?>" + 4, 16, 0), allDay: !1, className: "bg-primary" }, -->
                                 <?php
//                             }
//                         }
//                     }

//                 ?>


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->





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
     // var date = new Date(setDate(28));

        

// const d = new Date();
// var date =  d.setDate(15);

// alert(date);


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
        new FullCalendarInteraction.Draggable(document.getElementById("external-events"), {
            itemSelector: ".external-event",
            eventData: function (e) {
                return { title: e.innerText, className: g(e).data("class") };
            },
        });
       
        var c = [            
                <?php
                    if (isset($eventRow)) {
                        if ($eventRow>0) {
                            foreach ($eventResult as $value) {
                                $event_id = $value['id'];
                                $event_name = $value['event_name'];
                                $start_date = $value['start_date'];
                                $end_date = $value['end_date'];
                                $classname = $value['classname'];

                                $end_date=date_create($value['end_date']);
                                date_add($end_date,date_interval_create_from_date_string("1 days"));
                                $end_date_after = date_format($end_date,"Y-m-d");


                                ?>

                                // { title: "<?php echo  $event_name  ?>", start: "<?php echo  $start_date  ?>", end:new Date(o, d, n + 3, 22, 30), className: "<?php echo  $classname  ?>" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "<?php echo  $event_name  ?>", start: "<?php echo  $start_date  ?>", end:"<?php echo  $end_date_after;  ?>", className: "<?php echo  $classname  ?>" },

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


            v = (document.getElementById("external-events"), document.getElementById("calendar"));
        function u(e) {
            l.modal("show"), a.removeClass("was-validated"), a[0].reset(), g("#event-title").val(), g("#event-category").val(), t.text("Add Event"), (r = e);
        }
        var m = new FullCalendar.Calendar(v, {
            plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            editable: !0,
            droppable: !0,
            selectable: !0,
            defaultView: "dayGridMonth",
            themeSystem: "bootstrap",
            header: { left: "prev,next today", center: "title", right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth" },
            eventClick: function (e) {
                l.modal("show"), a[0].reset(), (i = e.event), g("#event-title").val(i.title), g("#event-category").val(i.classNames[0]), (r = null), t.text("Edit Event"), (r = null);
            },
            dateClick: function (e) {
                u(e);
            },
            events: c,
        });
        m.render(),
            g(a).on("submit", function (e) {
                e.preventDefault();
                g("#form-event :input");
                var t,
                    a = g("#event-title").val(),
                    n = g("#event-category").val();
                !1 === s[0].checkValidity()
                    ? (event.preventDefault(), event.stopPropagation(), s[0].classList.add("was-validated"))
                    : (i ? (i.setProp("title", a), i.setProp("classNames", [n])) : ((t = { title: a, start: r.date, allDay: r.allDay, className: n }), m.addEvent(t)), l.modal("hide"));
            }),
            g("#btn-delete-event").on("click", function (e) {
                i && (i.remove(), (i = null), l.modal("hide"));
            }),
            g("#btn-new-event").on("click", function (e) {
                u({ date: new Date(), allDay: !0 });
            });
    }),
        (g.CalendarPage = new e()),
        (g.CalendarPage.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.CalendarPage.init();
    })();



</script>


