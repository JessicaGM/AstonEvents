<?php include ("app/db/config.php"); ?>

<?php include ("app/reuse/head.php"); ?>

<body>
<?php include ("app/reuse/navbar.php"); ?>

<!-- Hero banner section -->
   <section class="hero">
            <div class="hero-text">
                <h1>Welcome to Aston Events</h1>
                <h3>This website is dedicated to our events!</h3>
                <a href="events.php" class="btn">Browse events</a>
            </div>
   </section>

<!-- About us section -->
    <section class="about-us">
                 <h2 class="about-title">About us</h2>
            <div class="row-about">
                 <div>
                    <h4 class="about-header">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                    <br>
                    <p class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                 </div>
                 <div>
                   <!-- Slideshow -->
                     <img class="slideshow" src="css/images/sports.jpeg" alt="Sport">
                     <img class="slideshow" src="css/images/culture.jpeg" alt="Culture">
                     <img class="slideshow" src="css/images/music.jpeg" alt="Live music">
                     <figcaption>Sport events, culture and many more.</figcaption>
                 </div>
            </div>
     </section>
<?php include ("app/reuse/footer.php"); ?>
</body>
</html>

<script>
// reference for the slideshow: https://www.w3schools.com/w3css/w3css_slideshow.asp
var slide = 0;
carousel();

function carousel() {
  var i;
  var j = document.getElementsByClassName("slideshow");
  for (i = 0; i < j.length; i++) {
    j[i].style.display = "none";
  }
  slide++;
  if (slide > j.length) {
    slide = 1;
  }
  j[slide-1].style.display = "block";
  setTimeout(carousel, 4000);
}
</script>
