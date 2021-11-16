<?php include ("app/db/config.php"); ?>

<?php include ("app/reuse/head.php"); ?>

<body>
<?php include ("app/reuse/navbar.php"); ?>

    <div id="content">
        <div class="container-fluid">
          <!-- Login form -->
            <form class="form" method="post" id="loginform">
                <h1 class="mt-3 mb-3">Login</h1>
                <div class="label-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@aston.ac.uk" title="Must contain your 9 digit ID with @aston.ac.uk ending" required minlength="21" maxlength="21">
                </div>
                <div class="label-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="label-group">
                    <button type="submit" name="submit" class="btn btn-primary" id="login">Log in</button>
                </div>
                <div class="label-group">
                  <label class="hrefSignup" for="hrefSignup">Not a member? <a href="signup.php" >Sign up now</a></label>
                </div>
            </form>
        </div>
    </div>

<?php include ("app/db/checkLogin.php"); ?>

<?php include ("app/reuse/footer.php"); ?>
</body>
</html>
