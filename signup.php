<?php include ("app/db/config.php"); ?>

<?php include ("app/reuse/head.php"); ?>

<body>
<?php include ("app/reuse/navbar.php"); ?>

    <div id="content">
        <div class="container-fluid">
               <!-- Sign up form -->
               <form class="form" method="post" id="signupform">
                    <h1 class="mt-3 mb-3">Sign up</h1>
                    <div class="label-group">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="First name">
                    </div>
                    <div class="label-group">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname">
                    </div>
                    <div class="label-group">
                        <label for="number" class="form-label">Telephone number</label>
                        <input type="tel" id="number" name="number" class="form-control" placeholder="e.g. 07123456789">
                    </div>
                    <div class="label-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@aston.ac.uk">
                    </div>
                    <div class="label-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="label-group">
                        <label for="confirmpassword" class="form-label">Confirm password</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="label-group">
                        <button type="submit" name="submit" class="btn btn-primary" id="signup">Sign up</button>
                    </div>
                    <div class="label-group">
                      <label class="hrefLogin" for="hrefLogin">Already have an account? <a href="login.php" >Log in</a></label>
                    </div>
               </form>
        </div>
    </div>

<?php include ("app/db/checkSignup.php"); ?>

<?php include ("app/reuse/footer.php"); ?>
</body>
</html>
