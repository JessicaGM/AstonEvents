<?php
  // prevent direct url access for /app/reuse/footer.php
  if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
      header("Location: ../../404.php");
      exit();
  };
?>

<!-- Social icons library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Footer -->
<div class="footer">
        <span class="text-muted"> &copy; <?php print date("Y");?> Aston Events </span>
        <span class="social_media">
          <a href="https://www.facebook.com/astonuniversity/" class="facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/AstonUniversity" class="twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/AstonUniversity" class="instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.youtube.com/AstonUniversity" class="youtube"><i class="fab fa-youtube"></i></a>
          <a href="https://www.linkedin.com/school/aston-university/" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
        </span>
</div>
