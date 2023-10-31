

        <link href="assets/calender/css/core/main.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/calender/css/daygrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/calender/css/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/calender/css/timegrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/calender/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/calender/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/calender/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>


            

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

      


        <!-- JAVASCRIPT -->
        <script src="admin/assets/libs/jquery/jquery.min.js"></script>

        <!-- plugin js -->
        <script src="assets/calender/js/core/main.min.js"></script>
        <script src="assets/calender/js/bootstrap/main.min.js"></script>
        <script src="assets/calender/js/daygrid/main.min.js"></script>
        <script src="assets/calender/js/timegrid/main.min.js"></script>
        <script src="assets/calender/js/interaction/main.min.js"></script>

    </body>
</html>


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
                
                                // { title: "Repulblic Day", start: "2023-01-26", end:new Date(o, d, n + 3, 22, 30), className: "bg-danger" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Repulblic Day", start: "2023-01-26", end:"2023-01-27", className: "bg-danger" },

                                
                                // { title: "Holi", start: "2023-03-07", end:new Date(o, d, n + 3, 22, 30), className: "bg-primary" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Holi", start: "2023-03-07", end:"2023-03-09", className: "bg-primary" },

                                
                                // { title: "Eid al-Fitr", start: "2023-04-21", end:new Date(o, d, n + 3, 22, 30), className: "bg-warning" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Eid al-Fitr", start: "2023-04-21", end:"2023-04-22", className: "bg-warning" },

                                
                                // { title: "Raksha Bandhan", start: "2023-08-30", end:new Date(o, d, n + 3, 22, 30), className: "bg-danger" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Raksha Bandhan", start: "2023-08-30", end:"2023-08-31", className: "bg-danger" },

                                
                                // { title: "Independance Day", start: "2023-08-15", end:new Date(o, d, n + 3, 22, 30), className: "bg-info" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Independance Day", start: "2023-08-15", end:"2023-08-16", className: "bg-info" },

                                
                                // { title: "Gandhi Jayanti", start: "2023-10-02", end:new Date(o, d, n + 3, 22, 30), className: "bg-success" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Gandhi Jayanti", start: "2023-10-02", end:"2023-10-03", className: "bg-success" },

                                
                                // { title: "Dussehra Navmi", start: "2023-10-24", end:new Date(o, d, n + 3, 22, 30), className: "bg-primary" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Dussehra Navmi", start: "2023-10-24", end:"2023-10-25", className: "bg-primary" },

                                
                                // { title: "Diwali", start: "2023-11-11", end:new Date(o, d, n + 3, 22, 30), className: "bg-secondry" },

                                // new Date("July 21, 1983 01:15:00")

                                { title: "Diwali", start: "2023-11-11", end:"2023-11-15", className: "bg-secondry" },

                                


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