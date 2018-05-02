<?php
session_start();
?>
<!DOCTYPE html>
<?php
if($_SESSION["userrole"] != "nurse"){
header('Location: garbage.html');
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="Nurse.css" rel="stylesheet">
</head>
    <body>
        <header>
            <nav>
                <ul>
                     <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
            <img src="images/300x300.png" alt="Logo">
        </header>
         <div>
            <a href="Nurse%20Medical%20Information.php"><img src="images/information.png" alt="Medical"></a><label>Enter Patient Medical Information</label><br>
            <a href="Patient%20Chart(Nurse).php"><img src="images/medicine-box-2-icon.png" alt="Patient"></a><label>View Patient Chart</label><br>
            <a href="AppointmentViewer.php" title="Appt"><img src="images/index.png" alt="Appointment"></a><label title="Appt"> View Appointments</label><br>
        </div>
    </body>
</html>