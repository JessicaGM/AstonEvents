<?php
include ("config.php");
include ("checkLogin.php");

// get type and id from event.php
if(isset($_GET['type'], $_GET['id'], $_SESSION['user_id'])) {
   $type = $_GET['type'];
   $id = (int)$_GET['id'];

 switch($type) {
   case 'event':
   // insert user_id and event_id only when event exists and only enable logged in user to like it once
   $sth=$db->query("INSERT INTO event_like (user_id, event_id, created)
                    SELECT {$_SESSION['user_id']}, {$id}, now()
                    FROM events
                    WHERE EXISTS (
                        SELECT event_id
                        FROM events
                        WHERE event_id = {$id})
                    AND NOT EXISTS (
                        SELECT event_id
                        FROM event_like
                        WHERE user_id = {$_SESSION['user_id']}
                        AND event_id = {$id})
                    LIMIT 1");
   break;
 }
}

// if liked and logged in, redirect back to the page
if (isset($_SESSION['user_id'])){
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
// if liked and not logged in, redirect to login page
  header('Location: ../../login.php');
}
?>
