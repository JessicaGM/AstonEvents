<?php
  // prevent direct url access for /app/db/sortEvents.php
  if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {
      header('HTTP/1.0 403 Forbidden', TRUE, 403);
      die(header( "Location: ../../404.php"));
  }

include ("config.php");

// if user selected from both event category and date
if($_POST['chosen_category'] && $_POST['chosen_date']) {
   $chosen_category=$_POST['chosen_category'];
   $chosen_date=$_POST['chosen_date'];
   // select from database based on category and date chosen from selector
   $sql = "SELECT * FROM events WHERE event_category='$chosen_category' AND event_date >= '$chosen_date' ORDER BY event_date ASC";
}

// if user selected only event category
else if($_POST['chosen_category']) {
   $chosen_category=$_POST['chosen_category'];
   // select from database only based on category chosen from selector
   $sql = "SELECT * FROM events WHERE event_category='$chosen_category' ORDER BY event_date ASC";
}

// if user selected only event date
else {
   $chosen_date=$_POST['chosen_date'];
   // select from database only based on date chosen from selector
   $sql = "SELECT * FROM events WHERE event_date >= '$chosen_date' ORDER BY event_date ASC";
}

$rows = $db->query($sql);

// if events exist
if ($rows->rowCount() > 0) {
   // if only 1 event available echo "event..."
   if($rows->rowCount() == 1){
      echo '<br>'.$rows->rowCount().' event available';
   } else {
   // else if more than 1 event available echo "events..."
      echo '<br>'.$rows->rowCount().' events available';
   }

   // retrieved from database using the foreach loop
   foreach ($rows as $row) {

      // event list templete
      include ($_SERVER['DOCUMENT_ROOT']."/app/reuse/eventList.php");
    }
} else {
// else if no events available echo "no events..."
?>
 <div class="events" id="events">
   <?php echo "No events available"; ?>
 </div>
<?php
}
?>
