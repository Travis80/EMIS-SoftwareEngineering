<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="Chart.css" rel="stylesheet">
</head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="NurseHome.php">Home</a></li>
                    <li><a href="Logout.php">Sign Out</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
            <img src="images/300x300.png" alt="Logo">
        </header>
        <form>
            <!-- Information from server goes into value quotation -->
            <label name="patient">Patient: </label><input type="text" name="patient" value="" readonly>
            <label name="date">Today's Date: </label><input type="text" name="date" value="" readonly><br><br>
            <label name="blood">Blood Type: </label><input type="text" name="blood" value="" readonly>
            <label name="weight">Weight: </label><input type="text" name="weight" value="" readonly>
            <label name="age">Age: </label><input type="text" name="age" value="" readonly><br><br>
            <label name="doctor">Preferred Doctor: </label><input type="text" name="doctor" value="" readonly>
            <label name="hospital">Preferred Hospital/Clinic: </label><input type="text" name="clinic" value="" readonly><br><br>
            <label name="allergy">Known Allergies: </label><br><textarea name="allergy" readonly><!--information goes here--></textarea><br><br>
            <label name="condition">Previous Medical Condition(s): </label><br><textarea name="condition" readonly><!--information goes here--></textarea><br><br>
            <label name="prescription">Prescription(s): </label><br><textarea name="prescription" readonly><!--information goes here--></textarea><br><br>
            <label name="test">Test Results, if any: </label><br><textarea name="results" readonly><!--information goes here--></textarea><br><br>
            <label name="diagnosis">Diagnosis: </label><br><textarea name="diagnosis" readonly><!--information goes here--></textarea><br><br>
        </form>
    </body>
</html>