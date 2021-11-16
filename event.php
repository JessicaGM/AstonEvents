<?php include ("app/db/config.php"); ?>
<?php include ("app/reuse/head.php"); ?>

<body>
  <?php include ("app/reuse/navbar.php"); ?>

  <div class="container">

      <?php
      // get event name from url ("view more" href located in app/reuse/eventList.php)
      $eventname=$_GET['name'];

      // count likes by all users for that event
      $stmt = $db->query("SELECT events.*,
                         COUNT(event_like.event_id) AS likes
                         FROM events
                         LEFT JOIN event_like
                         ON events.event_id = event_like.event_id
                         WHERE events.event_name='$eventname'");
      $stmt->execute();

      while($result = $stmt->fetchObject()){
        $events[]=$result;
      }

      //echo '<pre>',print_r($events, true),'<pre>';

      foreach($events as $row){
         $event=$row->event_name
      ?>

      <!-- Event information starts -->
            <section class = "event">
                <div class = "visuals">
                  <img src="<?="data:image/jpeg;base64,".base64_encode($row->event_img) ?>" class="img-thumbnail" alt=" <?= $row->event_name.' event image' ?>">
                  <div class="like">
                   <?php
                   // check if user logged in and if already liked the event
                   if (isset($_SESSION['user_id'])){
                   $sql = "SELECT * FROM events
                           INNER JOIN event_like
                           ON events.event_id=event_like.event_id WHERE
                           event_like.user_id={$_SESSION['user_id']} AND event_like.event_id={$row->event_id}";
                   $rows = $db->query($sql);

                    // if user logged in and already liked, display already liked button
                    if ($rows->rowCount() > 0) { ?>
                       <a href="" class="btn-liked"><span class="fa fa-heart"></span>  Liked <?php echo $row->likes?></a>
                    <?php } else {
                    // if user logged in and not liked, display like button
                    ?>
                       <a href="app/db/like.php?type=event&id= <?php echo $row->event_id; ?>" class="btn-like"><span class="fa fa-heart"></span>  Like <?php echo $row->likes?></a>
                    <?php } }else {
                    // if user not logged in, display like button
                    ?>
                       <a href="app/db/like.php?type=event&id= <?php echo $row->event_id; ?>" class="btn-like"><span class="fa fa-heart"></span>  Like <?php echo $row->likes?></a>
                   <?php } ?>

                  </div>
                </div>
                <div class="content">
                  <h2> <?= $row->event_name ?> </h2>
                  <p>  <?= $row->event_description ?> <p>
                    <div class ="information">
                      <p> Date: <?= date("jS F Y", strtotime($row->event_date)) ?> </p>
                      <p> Event type: <?= $row->event_category ?> </p>
                      <p> Time: <?= date("H:s", strtotime($row->event_start_time))." - ".date("H:s", strtotime($row->event_end_time)) ?> </p>
                      <p> Organiser: <?= $row->event_organiser ?> </p>
                      <p> Venue: <?= $row->event_venue ?> <a href="https://www.google.co.uk/maps?q= <?= $row->event_venue ?>">view on map</a></p>
                      <p> Contact: <?= $row->event_contact ?> </p>
                      <p> Event website: <a href="<?= $row->event_URL ?>">here</a></p>
                    </div>
                  <form id="booking" method ="post">
                    <br>
                    <button type="submit" name="book" id="submit" class="btn btn-primary button-book">Click here to book</button>
                  </form>
                </div>
            </section>
      <!-- Event information ends -->

      <?php
      }
    // check if allowed to book
    include ("app/db/checkBooking.php");
    ?>
  </div>
<?php include ("app/reuse/footer.php"); ?>
</body>
</html>
