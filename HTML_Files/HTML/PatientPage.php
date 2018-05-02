<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="home.css" rel="stylesheet">
</head>
<?php
if($_SESSION["userrole"] != "patient"){
header('Location: garbage.html');
}
?>
    <body>
        <header>
            <nav>
                <ul>
		    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="Employee%20Login%20Page.php">Employee</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
            <img src="images/300x300.png" alt="Logo">
        </header>
        <div>
            <a href="Medical%20Information.php"><img src="images/information.png" alt="Medical"></a><label>Enter Your Medical Information</label><br>
            <a href="Contact%20Us.php"><img src="images/chat.png" alt="Chat"></a><label>Contact Us</label><br>
            <a href="PersonalInfo.php"><img src="images/xtqwqiphehtgofvznyec.png" alt="Personal"></a><label>Enter Your Personal Information</label><br>
            <a href="Payment.php"><img src="images/cash-icon.png" alt="Cash"></a><label>Payment Information</label><br>
            <a href="CalenderScheduler.php" title="Appt"><img src="images/index.png" alt="Appointment"></a><label title="Appt">Schedule Appointments</label><br>
        </div>
    </body>
</html>