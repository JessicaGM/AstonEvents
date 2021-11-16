<?php include ("app/db/config.php"); ?>

<?php include ("app/reuse/head.php"); ?>

<body>
<?php include ("app/reuse/navbar.php"); ?>

        <div class="container" id="container">
            <div class="header">
                 <h2>Events</h2>
                  <p>Join our events!<br>Click view more to see the details, book or like the event.</p>
                   <form class="form-selectors">
                      <div class="row">
                        <!-- Event category selector -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="filter_event_category" class="form-label">Event type:</label>
                            <select name="filter_event_category" id="filter_event_category" class="form-select">
                              <option selected="true" disabled>Select event category</option>
                              <option value="Sport">Sport</option>
                              <option value="Culture">Culture</option>
                              <option value="Other">Other</option>
                            </select>
                          </div>
                        </div>
                        <!-- Date from selector -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="filter_event_date" class="form-label">Events from:</label>
                            <input type="date" name="filter_event_date" id="filter_event_date" class="form-control">
                          </div>
                        </div>
                      </div>
                   </form>
              </div>
            <!-- Events list starts -->
            <div id="category">
               <?php
                // default (if user have NOT pressed any selector, select all events)
                $sql = "SELECT * FROM events ORDER BY event_date ASC";
                $rows = $db->query($sql);
                // display count of events available
                echo '<br>'.$rows->rowCount().' events available';

               foreach ($rows as $row) {
                 // event list templete
                 include ("app/reuse/eventList.php");
               }
               ?>
        </div>
        <!-- Events list ends -->


<?php include ("app/reuse/footer.php"); ?>
</body>
</html>

<script>
// if user has chosen from selector
jQuery(document).ready(function ($) {
	$("form").on("change", function () {
		var chosen_category = $('#filter_event_category').val();
    var chosen_date = $('#filter_event_date').val();
		$.ajax({
			url: "app/db/sortEvents.php",
			type: "POST",
			data: {chosen_category:chosen_category, chosen_date:chosen_date},
			success: function (data) {
				$("#category").html(data);
			}
		});
	});
});
</script>
