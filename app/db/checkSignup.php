<?php
if (!isset($_SESSION['user_id'])){

   // check if details not empty
   if (isset($_POST['name'], $_POST['surname'], $_POST['number'], $_POST['email'])) {
      $name=$_POST['name'];
      $surname=$_POST['surname'];
      $number=$_POST['number'];
      $email=$_POST['email'];
   } else {
      //echo "Please enter your details"; <- handled by signupvalidation.js
      exit();
}
// check if password not empty and both passwords match
if (!empty(trim($_POST['password']) && $_POST['password'] == $_POST['confirmpassword'])) {
      $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
      //echo "Please enter and confirm your password"; <- handled by signupvalidation.js
      exit();
}

  try {
     // check if account already exists with the same email
     $sth = $db->prepare("SELECT * FROM users WHERE email=?");
     $sth->execute([$email]);

     if ($sth->fetch()) {
         echo '<script>alert("Your account already exists, please log in instead.")</script>';
     } else {
         // insert information from login form to database
         $sth=$db->prepare("INSERT INTO users VALUES (null,:name,:surname,:number,:email,:password,now(),now())");
         $sth->bindParam(':name', $name, PDO::PARAM_STR, 64);
         $sth->bindParam(':surname', $surname, PDO::PARAM_STR, 64);
         $sth->bindParam(':number', $number, PDO::PARAM_STR, 11);
         $sth->bindParam(':email', $email, PDO::PARAM_STR, 64);
         $sth->bindParam(':password', $password, PDO::PARAM_STR, 64);
         $sth->execute();
         echo '<script>alert("You have been successfully registered, you can now log in.")</script>';
     }
  } catch (PDOException $ex) {
    echo("Failed to connect to the database");
    //echo $ex->getMessage();
  }
}
?>
