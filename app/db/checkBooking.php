<?php
include ("config.php");
include ("checkLogin.php");
// when pressed book button check if logged in
if (isset($_POST["book"])) {
    // if logged in
    if (isset($_SESSION["email"])) {
        $email=$_SESSION["email"];
        $event=$row->event_name;

        // check if student already booked for this event
        $sth = $db->prepare("SELECT * FROM booked_event WHERE email=? AND event_name=?");
        $sth->execute(array($email,$event));
          // if both event and email found in booked_event table show alert
          if ($sth->fetch()) {
              echo '<script>alert("You have already registered for this event, please check your profile.")</script>';
          } else {
               // else if both event and email NOT found in booked_event table show confirm button with details and alert
              echo '<script>alert("Please scroll down the page and confirm the booking.")</script>';
                echo '<div class="confirmBookingForm bg-white shadow-lg p-3 mb-5">';
                  echo '<form class="form" method="post" id="bookingform">';
                    echo '<div class="label-group">';
                      echo '<h5>Please confirm to book</h5>';
                    echo '</div>';
                    echo '<div class="label-group">';
                        echo '<label for="email" class="form-label">Your email address:</label>';
                        echo '<input type="email" id="email" name="email" class="form-control" placeholder="'.$email.'" disabled>';
                    echo '</div>';
                    echo '<div class="label-group">';
                        echo '<label for="event" class="form-label">The event you are booking for:</label>';
                        echo '<input type="text" id="event" name="event" class="form-control" placeholder="'.$event.'" disabled>';
                    echo '</div>';
                    echo '<div class="label-group">';
                        echo '<button type="submit" name="confirm" id="submit" class="btn btn-primary button-confirm">Confirm</button>';
                        echo '<button name="cancel" id="cancel" class="btn btn-secondary" style="margin:10px;" value="1">Cancel</button>';
                    echo '</div>';
                  echo '</from>';
                echo '</div>';
         }
} else {
 // else if user not logged in show alert
 echo '<script>alert("Please log in to book the event.")</script>';
 }
}

// if still logged in and pressed confirm button then book the event
if (isset($_POST["confirm"])) {
    if (isset($_SESSION["email"])) {
        $email=$_SESSION["email"];
        $event= $row->event_name;
        try {

            // insert information about booking to database
            $sth=$db->prepare("INSERT INTO booked_event VALUES (null,:email,:event_name,now())");
            $sth->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $sth->bindParam(':event_name', $event, PDO::PARAM_STR, 64);
            $sth->execute();

            echo '<script>alert("You have successfully booked the event.")</script>';
        } catch (PDOException $ex) {

            //echo $ex->getMessage();
        }
    } else {
        echo '<script>alert("Please log in to book the event.")</script>';
    }
}
