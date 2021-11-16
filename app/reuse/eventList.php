                 <?php
                 // prevent direct url access for /app/reuse/eventList.php
                 if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {
                     header('HTTP/1.0 403 Forbidden', TRUE, 403);
                     die( header("Location: ../../404.php"));
                 }

                 // event list layout  (for events.php and /app/db/sortEvents.php)?>

                 <div class="events" id="events">
                      <div class="date">
                          <p class="day"> <?= date("jS", strtotime($row['event_date'])) ?> </p>
                          <p class="month_n_year"> <?= date("F Y", strtotime($row['event_date'])) ?> </p>
                      </div>
                      <div class="description">
                          <p class="event_name"> <?= $row['event_name'] ?> </p>
                          <?=
                          // show first 30 words from description
                          implode(' ', array_slice(str_word_count($row['event_description'], 2), 0, 30)).'...'?><br>
                          <br>
                          Event type: <?= $row['event_category'] ?>
                          <br>
                          Time: <?= date("H:s", strtotime($row['event_start_time']))." - ".date("H:s", strtotime($row['event_end_time'])) ?>
                      </div>
                      <div class="view">
                          <a href ="event.php?name=<?php echo $row['event_name'] ?>">View more</a>
                      </div>
                  </div>
