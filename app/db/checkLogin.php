<?php
// validate login with database, influenced from the lab
if (isset($_POST['submit'])) {
   if (!isset($_POST['email'], $_POST['password'])) {
     exit("Please fill in your email and password");
   }

   try {
     // check if email exists in database
     $stat = $db->prepare("SELECT * FROM users WHERE email = ?");
     $stat->execute(array($_POST['email']));

     // if email exists in database
     if ($stat->rowCount()>0) {
        $row=$stat->fetch();

        // verify password with database
        if (password_verify($_POST['password'], $row['password'])) {
            session_start();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['user_id'] = $row['user_id'];
            //echo '<pre>',print_r($row, true),'<pre>';

            // correct password and email, show profile page
            header("Location: profile.php");
            exit();
        } else {
            // incorrect password
            echo '<script>alert("Please enter your correct email address and password")</script>';
        }
     } else {
        // email not found
        echo '<script>alert("We cannot find your email, have you registered first?")</script>';
     }
   } catch (PDOException $ex) {
        echo("Failed to connect to the database");
        //echo($ex->getMessage());
        exit();
   }
}
?>
