<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                         <?php if (isset($_SESSION['user']))
                            { 
                                ?>
                                 <li><a href="#">Welcome <?php echo $_SESSION['user']; ?></a></li>
                                 <?php
                            }
                            else
                            {
                                ?>
                                 <li><a href="#">Welcome message</a></li>
                                <?php
                            }
                        ?>
                       
                        <li><a href="index.php">Flights</a></li>

                        <?php if (isset($_SESSION['user']))
                            { 
                                ?>
                                 <li><a href="logout.php">Logout</a></li>
                                 <?php
                            }
                            else
                            {
                                ?>
                                 <li><a href="login.php">Login</a></li>
                                <?php
                            }
                        ?>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Join as a Wordskills Travel Member</h2>
                   
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <form action="" method="POST" class="form-horizontal" role="form" onsubmit="return validateForm();">
                
                            <div class="form-group">
                                <label for="fullname" class="control-label col-sm-2">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your username" aria-required="true" required="required" onkeyup="validateFname()">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="control-label col-sm-2">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" class="form-control" aria-required="true" required="required" placeholder="Your email" onkeyup="validateEmail()">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" id="password" aria-required="true" required="required" placeholder="Password" class="form-control" onkeyup="validatePass()">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="repassword" class="control-label col-sm-2">Retype Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="repassword" id="repassword" placeholder="Retype Password" aria-required="true" required="required" class="form-control" onkeyup="validateRePass()">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="repassword" class="control-label col-sm-2">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone" id="phone" placeholder="Retype Phone" aria-required="true" required="required" class="form-control" onkeyup="validatePhone()">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button name="register" type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                    </form>
                    <?php 
                        require "db/db.php";
                        $db = new db();
                        $checkEmail = $db->checkEmail($_POST['email']);
                        if (isset($_POST['register']))
                        {
                            if ($checkEmail > 0)
                            {
                                ?>
                                <div class="alert alert-warning">
                                    <strong>
                                        Email already exists. Registration failed!
                                     </strong>
                                </div>
                            <?php 
                            }
                            else
                            {
                                $first_name = $_POST['name'];
                                $pass = sha1($_POST['password']);
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $db->insertUser($first_name, $pass, $email, $phone);
                               ?>
                               <div class="alert alert-success">
                                    <strong>
                                        Sign Up Success!
                                     </strong>
                                </div>
                               <?php
                            }
                        }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p class="text-center">
                Copyright &copy; 2017 | All Right Reserved
            </p>
        </div>
    </footer>
</div>
<!--scripts-->
<script type="text/javascript" src="assets/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        function validateForm() {
            if (validateFname()  & validateEmail() & validatePass() & validateRePass() & validatePhone()) {
                return true;
            }
            else {
                return false;
            }
        }

        function validatePass() {
            var field = $('#password').val();
            var filter = /^.{6,}$/;

            if (!filter.test(field)) {
                $('#password').parent().parent().addClass('has-error');
                $('#password').parent().parent().removeClass('has-success');
                $('#password').next().html('Pass min 6 character!');
                return false;
            }
            else {
                $('#password').parent().parent().removeClass('has-error');
                $('#password').parent().parent().addClass('has-success');
                $('#password').next().html('');
                return true;
            }
        }

        function validateFname() {
            var field = $('#name').val();
            var filter = /^\w+$/;

            if (!filter.test(field)) {
                $('#name').parent().parent().addClass('has-error');
                $('#name').parent().parent().removeClass('has-success');
                $('#name').next().html('Name Invalid!');
                return false;
            }
            else {
                $('#name').parent().parent().removeClass('has-error');
                $('#name').parent().parent().addClass('has-success');
                $('#name').next().html('');
                return true;
            }
        }

        function validateLname() {
            var field = $('#lname').val();
            var filter = /^\w+$/;

            if (!filter.test(field)) {
                $('#lname').parent().parent().addClass('has-error');
                $('#lname').parent().parent().removeClass('has-success');
                $('#lname').next().html('Last Name Invalid!');
                return false;
            }
            else {
                $('#lname').parent().parent().removeClass('has-error');
                $('#lname').parent().parent().addClass('has-success');
                $('#lname').next().html('');
                return true;
            }
        }

        function validateEmail() {
            var field = $('#email').val();
            var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[a-z]{2,4})+$/;

            if (!filter.test(field)) {
                $('#email').parent().parent().addClass('has-error');
                $('#email').parent().parent().removeClass('has-success');
                $('#email').next().html('Email Invalid');
                return false;
            }
            else {
                $('#email').parent().parent().removeClass('has-error');
                $('#email').parent().parent().addClass('has-success');
                $('#email').next().html('');
                return true;
            }
        }

        function validateRePass() {
            var psw = $('#password').val();
            var repsw = $('#repassword').val();

            if (repsw != psw) {
                $('#repassword').parent().parent().addClass('has-error');
                $('#repassword').parent().parent().removeClass('has-success');
                $('#repassword').next().html('Password not match');
                return false;
            }
            else {
                $('#repassword').parent().parent().removeClass('has-error');
                $('#repassword').parent().parent().addClass('has-success');
                $('#repassword').next().html('');
                return true;
            }
        }

        function validatePhone() {
          var field = $('#phone').val();
          var filter = /^\d{10,11}$/;

          if (!filter.test(field)) {
            $('#phone').parent().parent().addClass('has-error');
            $('#phone').parent().parent().removeClass('has-success');
            $('#phone').next().html('Phone numbers from 10 to 11 number');
            return false;
          }
          else {
            $('#phone').parent().parent().removeClass('has-error');
            $('#phone').parent().parent().addClass('has-success');
            $('#phone').next().html('');
            return true;
          }
        }
    </script>
</body>
</html>