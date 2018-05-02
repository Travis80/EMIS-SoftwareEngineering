<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="Doctor.css" rel="stylesheet">
</head>
<?php
if($_SESSION["userrole"] != "doctor"){
header('Location: garbage.html');
}
?>
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
            <a href="Patient%20Chart(View).php"><img src="images/medicine-box-2-icon.png" alt="Patient"></a><label title ="Chart">View Patient Chart</label><br>
            <a href="Patient%20Chart(Edit).php"><img src="images/prescription-icon.png" alt="Patient"></a><label title="Update">Manually Update Patient Chart</label><br>
            <a href="Prescriptions.php"><img src="images/prescription.jpg" alt="Prescription"></a><label title="Prescription">Prescriptions</label><br>
            <a href="Diagnosis.php" title="Diagnosis"><img src="images/256-256-76170ff571088c191d2cf8e74e911e11.png" alt="Diagnosis"></a><label title="Diagnosis">Diagnosis</label><br>
            <a href="Results.php" title="Result"><img src="images/laboratory-analysis-icon-flat-design-vector-7213040.jpg" alt="Test"></a><label title="Test"> Test Results</label><br>
            <a href="AppointmentViewer.php" title="Appt"><img src="images/index.png" alt="Appointment"></a><label title="Appt"> View Appointments</label><br>
        </div>
    </body>
</html>