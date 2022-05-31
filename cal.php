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
      navLinks: true,
      editable: false,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true,
      eventClick: function(info) {
        if ( typeof favDialog.showModal !== 'function' ) {
            alert("This function is not supported by this browser!")   
        }
        else
        {
        document.getElementById("id").innerHTML =  "Id: " + info.event.id;
        document.getElementById("title").innerHTML =  "Title: " + info.event.title;
        document.getElementById("start").innerHTML =  "End time: " + info.event.start.toISOString().substring(0, 19);
        document.getElementById("end").innerHTML =  "End time: " + info.event.end.toISOString().substring(0, 19);
        favDialog.showModal();
        }
    },
      events: json,
    });
    calendar.render();
  });

</script>
<style>

  html, body {
    overflow: hidden;
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

  dialog {
  border: none !important;
  border-radius: 15px;
  box-shadow: 0 0 #0000, 0 0 #0000, 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  padding: 1.6rem;
  max-width: 400px;
}

</style>
</head>
<body>
<div id='calendar-container'>
    <div id='calendar'></div>
  </div>
<dialog id="favDialog" close>
<form method="dialog">
    <p id="id"></p>
    <p id="title"></p>
    <p id="start"></p>
    <p id="end"></p>
    <div>
      <button value="cancel">Cancel</button>
      <button id="confirmBtn" value="default">Confirm</button>
    </div>
  </form>
</dialog>
</body>
</html>
