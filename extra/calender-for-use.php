<?php
  include 'header.php';
  include 'profileHeader.php';
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css">

<style>

#calendar {
  max-width: 1100px;
  margin: 40px auto;
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

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: '2020-09-07',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: [
      {
        title: 'All Day Event',
        start: '2020-09-01'
      },
      {
        title: 'Long Event',
        start: '2020-09-07',
        end: '2020-09-10'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        start: '2020-09-09T16:00:00'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        start: '2020-09-16T16:00:00'
      },
      {
        title: 'Conference',
        start: '2020-09-11',
        end: '2020-09-13'
      },
      {
        title: 'Meeting',
        start: '2020-09-12T10:30:00',
        end: '2020-09-12T12:30:00'
      },
      {
        title: 'Lunch',
        start: '2020-09-12T12:00:00'
      },
      {
        title: 'Meeting',
        start: '2020-09-12T14:30:00'
      },
      {
        title: 'Birthday Party',
        start: '2020-09-13T07:00:00'
      },
      {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2020-09-28'
      }
    ]
  });

  calendar.render();
});
</script>

  </body>
</html>


<!-- https://codepen.io/camerongoddard/pen/PopqzVZ -->