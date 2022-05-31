<?php
require_once 'conn.php';
$sql = "SELECT * FROM data";
$result = $conn->query($sql);
$json;

if ($result->num_rows > 0) {
  $arrList = array();
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $arr = array(
      'id' => $row["id"],
      'title' => $row["title"],
      'start' => $row["start"],
      'end' => $row["end"]
    );
    array_push($arrList, $arr);
  }
  $json = json_encode($arrList);
}
?>
<script>
    function getJsonData() {
      return <?php echo $json; ?>;
    }
  </script>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='lib/main.css' rel='stylesheet' />
<script src='lib/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    let json = getJsonData();
    var calendar = new FullCalendar.Calendar(calendarEl, {
      height: '100%',
      expandRows: true,
      slotMinTime: '08:00',
      slotMaxTime: '23:00',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,timeGridWeek'
      },
      initialView: 'timeGridWeek',
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true, // allow "more" link when too many events
      eventClick: function(info) {
        alert('Event: ' + info.event.id + '\nTitle: ' + info.event.title);
        // change the border color just for fun
        info.el.style.borderColor = 'red';
    },
      events: json,
    });

    calendar.render();
  });

</script>
<style>

  html, body {
    overflow: hidden; /* don't do scrollbars */
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar-container {
    position: fixed;
    margin: 30px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .fc-header-toolbar {
    /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  }

</style>
</head>
<body>

  <div id='calendar-container'>
    <div id='calendar'></div>
  </div>

</body>
</html>
