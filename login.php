<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
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
                        <li><a href="#">Welcome message</a></li>
                        <li><a href="index.php">Flights</a></li>
                        <li><a href="login.php">Log In</a></li>
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
                    <h2>Log in to your account</h2>
                    <?php

                        if ($_SESSION['fail_3time'])
                        {
                             unset($_SESSION['loginfail']);
                            ?>
                             <div class="alert alert-danger">
                                <strong>
                                    <?php echo  $_SESSION['fail_3time'];
                                          unset($_SESSION['fail_3time']); ?>
                                </strong>
                            </div>
                            <?php
                        }
                        if ($_SESSION['loginfail'])
                        {
                            ?>
                             <div class="alert alert-danger">
                                <strong>
                                    <?php echo  $_SESSION['loginfail'];
                                          unset($_SESSION['loginfail']); ?>
                                </strong>
                            </div>
                            <?php
                        }

                    ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="xuly-login.php" method="post">
                                <div class="form-group">
                                    <label class="control-label">Email Address:</label>
                                    <input type="email" required="required" name="email" class="form-control" placeholder="Enter your email address">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input type="password" required="required" name="password" class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="login" class="btn btn-primary">Log In</button>
                                </div>
                            </form>
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
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>