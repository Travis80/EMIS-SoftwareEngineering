<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="forms.css" rel="stylesheet">
</head>
    <body>
     <header>
            <nav>
                <ul>
                    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="DoctorHome.php">Home</a></li>
                     <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
            <img src="images/300x300.png" alt="Logo">
        </header>
        <form autocomplete="off">
            Patient Name: <input type="text" name="patient"><br><br>
            Patient Condition: <br><textarea name="condition" readonly></textarea><br>
            Patient Condition(Updated): <br><textarea name="updated"></textarea><br>
            Diagnosis: <br><textarea name="diagnosis"></textarea><br><br>
            Signature: <input type="text" name="sign">
            Date: <input type="text" name="date">
            <input type="submit" value="Submit"><br>
        </form>
    </body>
</html>