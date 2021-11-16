<?php
  // prevent direct url access for /app/reuse/navbar.php
  if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
      header("Location: ../../404");
      exit();
  };
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href=""> <img src="css/images/astonlogowhite.png" alt="Aston Logo" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="events.php">Events</a>
                </li>

             <?php
             if (isset($_SESSION['email']) === true) {
                // display profile and logout if user logged in
                echo '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
             } else {
                // display signup and login if user not logged in
                echo '<li class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Login/Sign up</a>';
                echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                echo '<li><a class="dropdown-item" href="signup.php">Sign up</a></li>';
                echo '<li><a class="dropdown-item" href="login.php">Login</a></li>';
                echo '</ul></li>';
             } ?>
            </ul>
        </div>
    </div>
</nav>
