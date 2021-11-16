<?php include ("app/db/config.php"); ?>
<?php include ("app/db/checkBooking.php"); ?>

<?php include ("app/reuse/head.php"); ?>

<body>
  <?php include ("app/reuse/navbar.php"); ?>
     <div id="content">
         <div class="container">

           <?php
           // if user not logged in redirect to login form
           if (!isset($_SESSION['user_id'])){
             header('Location: login.php');
           }
           ?>

           <?php
           // if user logged in show profile
           if (isset($_SESSION['user_id'])){
           ?>
           <!-- Profile information-->
              <h3 style="font-weight:bolder;">Profile</h3>
                 <?php
                 $rows = $db->query("SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}");
                 foreach ($rows as $row) {
                         echo '<b style="font-size:1.2em;">Hello '.$row['name'].' '.$row['surname'].',</b>';
                 }
                 ?>

                    <?php
                    // if user logged in show their events booked
                    if (isset($_SESSION["email"])) {
                        $email=$_SESSION["email"];

                        // if pressed asc, order events by ascending dates
                        if(isset($_POST['asc'])) {
                           $sql = "SELECT * FROM events
                                   INNER JOIN booked_event
                                   ON events.event_name=booked_event.event_name WHERE
                                   booked_event.email='$email' ORDER BY events.event_date ASC";
                        }
                        // if pressed desc, order events by descending dates
                        elseif (isset ($_POST['desc'])) {
                           $sql = "SELECT * FROM events
                                   INNER JOIN booked_event
                                   ON events.event_name=booked_event.event_name WHERE
                                   booked_event.email='$email' ORDER BY events.event_date DESC";
                        }
                        // if pressed earliest, order events by earliest registered event by the user
                        elseif (isset ($_POST['earliest'])) {
                           $sql = "SELECT * FROM events
                                   INNER JOIN booked_event
                                   ON events.event_name=booked_event.event_name WHERE
                                   booked_event.email='$email' ORDER BY booked_event.created ASC";
                        }
                        // if pressed latest, order events by latest registered event by the user
                        elseif (isset ($_POST['latest'])) {
                           $sql = "SELECT * FROM events
                                   INNER JOIN booked_event
                                   ON events.event_name=booked_event.event_name WHERE
                                   booked_event.email='$email' ORDER BY booked_event.created DESC";
                        }  else {
                        // default (if not pressed), order events by latest registered event by the user
                           $sql = "SELECT * FROM events
                                   INNER JOIN booked_event
                                   ON events.event_name=booked_event.event_name WHERE
                                   booked_event.email='$email' ORDER BY booked_event.created DESC";
                        }

                        $rows = $db->query($sql);
                           // if user has booked events
                           if ($rows->rowCount() > 0) {
                                // if user has only 1 booked event
                                if($rows->rowCount() == 1){
                                      echo '<br>'.'You have registered for '.$rows->rowCount().' event.';
                                } else {
                                // if user has more than one booked event
                                      echo '<br>'.'You have registered for '.$rows->rowCount().' events.';
                                } ?>

                                <!-- Sort buttons -->
                                <form action="profile.php" method="post" style="margin-top: 10px;">
                                   <label for="submit"> Sort your booked events by: </label><br>
                                   <input type="submit" class="profile-sort-button" name="asc" value="Ascending dates">
                                   <input type="submit" class="profile-sort-button" name="desc" value="Descending dates">
                                   <input type="submit" class="profile-sort-button" name="earliest" value="Earliest registered">
                                   <input type="submit" class="profile-sort-button" name="latest" value="Latest registered">
                                </form>

                                <!-- Table - booked events by the user -->
                                <table class="table_user_events">
                                  <thead>
                                  <tr>
                                    <th>Event:</th>
                                    <th>Category:</th>
                                    <th>Date:</th>
                                    <th>Time:</th>
                                    <th>Organiser:</th>
                                    <th>Contact:</th>
                                    <th>Venue:</th>
                                    <th>You have registered at:</th>
                                  </tr>
                                  </thead>

                                <?php
                                foreach ($rows as $row) { ?>

                                  <tbody>
                                  <tr>
                                    <td><?= $row['event_name'] ?></td>
                                    <td><?= $row['event_category'] ?></td>
                                    <td><?= $row['event_date'] ?></td>
                                    <td><?= date("H:s", strtotime($row['event_start_time']))." - ".date("H:s", strtotime($row['event_end_time'])) ?></td>
                                    <td><?= $row['event_organiser'] ?></td>
                                    <td><?= $row['event_contact'] ?></td>
                                    <td><?= $row['event_venue'] ?></td>
                                    <td><?= $row['created'] ?></td>

                                <?php } ?>
                                  </tr>
                                  </tbody>
                                </table>
                              <?php
                           } else {
                               // if user has no booked events
                                echo "<br>You have not registered for any events. Let's change that, head to our events page and book! :)";
                           }
                    }
           } ?>

         </div>
     </div>
<?php include ("app/reuse/footer.php"); ?>
</body>
</html>
