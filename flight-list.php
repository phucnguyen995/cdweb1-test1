<?php
    session_start();
    require "db/db.php";
    $db = new db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flights - Worldskills Travel</title>
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
            <section>
                <?php
                    $nameFrom = $db->getCityById('city_from', $_GET['from']);
                    $nameTo = $db->getCityById('city_to', $_GET['to']);
                ?>
                <h2><?php  echo  $nameFrom['name_city'] ?> <i class="glyphicon glyphicon-arrow-right"></i> <?php  echo  $nameTo['name_city'] ?> </h2>
                <?php 

                   $listFly = $db->searchFlight($_GET['from'], $_GET['to']);
                   foreach ($listFly as $row) {
                ?>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong><a href="flight-detail.html"><?php echo $row['airways'] ?></a></strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time"><?php echo $row['time_from'] ?></big></div>
                                            <div><span class="place"><?php echo  $nameFrom['name_city'] ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time"><?php echo $row['time_to'] ?></big></div>
                                            <div><span class="place"> <?php  echo  $nameTo['name_city'] ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time"><?php echo $row['duration'] ?></big></div>
                                    
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong><?php echo number_format($row['price']);  ?> VNĐ</strong></h3>
                                            <div>
                                                <a href="flight-detail.php?from=<?php echo $_GET['from'] ?>&to=<?php echo $_GET['to'] ?>&flight_type=<?php echo $_GET['flight_type'] ?>&person=<?php echo $_GET['person'] ?>&flight_class=<?php echo $_GET['flight_class'] ?>&id=<?php echo $row['id'] ?>" class="btn btn-link">See Detail</a>
                                                <a href="login.php" onclick="alert('You need to login');" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
                <div class="text-center">
                    <ul class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">&lsaquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&rsaquo;</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </section>
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