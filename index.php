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
                                 <li><a href="profile.php">Welcome <?php echo $_SESSION['user']; ?></a></li>
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
                <h3>Flight Booking</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" action="flight-list.php" onsubmit="return validateForm();">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
										<select class="form-control" name="from" id="from">
                                            <?php 
                                                $cityFrom = $db->getCity('city_from');
                                                foreach ($cityFrom as $row) {
                                             ?>
											<option value="<?php echo  $row['id'] ?>">
                                                <?php echo  $row['name_city'] ?>
                                            </option>
											<?php } ?>
										</select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="to" id="to">
											<?php 
                                                $cityTo = $db->getCity('city_to');
                                                foreach ($cityTo as $row) {
                                             ?>
                                            <option value="<?php echo  $row['id'] ?>">
                                                <?php echo  $row['name_city'] ?>
                                            </option>
                                            <?php } ?>
										</select>       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                         <?php $dateNow = date('Y-m-d'); ?>
                                        <input value="<?php echo $dateNow ?>" required="required" id="departure" name="date" type="date" class="form-control" placeholder="Choose Departure Date">
                                    </div>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" id="onway" name="flight_type" checked value="one-way" onclick="unCheckReturn()">One Way</label>
                                            <label><input type="radio" id="checkreturn" name="flight_type" value="return" onclick="checkReturn()">Return</label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="return" style="display: none;">
                                        <label class="control-label">Return: </label>
                                        <input value="<?php echo $dateNow ?>"  type="date" class="form-control" placeholder="Choose Return Date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Search Flights</h4>
                                    <div class="form-group">
                                        <label class="control-label">Total Person: </label>
                                        <select class="form-control" name="person">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Flight Class: </label>
                                        <select class="form-control" name="flight_class">
                                            <option value="economy">Economy</option>
                                            <option value="business">Business</option>
                                            <option value="premium-economy">Premium Economy</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search Flights</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
<script type="text/javascript">
    function checkReturn() {
    document.getElementById("return").style.display = "block";
    }

    function unCheckReturn() {
    document.getElementById("return").style.display = "none";
    }

        // validate
     function validateForm() {
        //& validateTime()
            if (validateCity() &  validateTime()) {
                return true;
            }
            else {
                return false;
            }
        }

    function validateCity() {
            var form = $('#from').val();
            var to = $('#to').val();

            if(form == to)
            {
              alert("Thành phố đến và đi phải khác nhau!");         
              return false;
            }
            else
            {
                return true;
            }

           
        }
        //departure
        function validateTime() {
            var time_departure = $('#departure').val();
            var dateChoose = new Date(time_departure);
            var dateNow = new Date();

            if(dateChoose.getDay() >= dateNow.getDay())
            {                   
              return true;
            }
            else
            {
                alert("Ngày đặt vé phải lớn hoặc bằng ngày hiện tại!");  
                return false;
            }

           
        }
</script>
</body>
</html>