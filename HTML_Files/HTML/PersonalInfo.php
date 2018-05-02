<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="PersonalInfo.css" rel="stylesheet">
    </head>
    <body>
<?php
if($_SESSION["userrole"] != "nurse" and $_SESSION["userrole"] != "doctor" and $_SESSION["userrole"] != "patient"){
header('Location: garbage.html');
}
?>
	<header>
            <nav>
                <ul>
                    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="<?php if($_SESSION["userrole"] == "nurse")
                            {echo "NurseHome.php";} 
			elseif($_SESSION["userrole"] == "doctor")
			    {echo "DoctorHome.php";} 
			elseif($_SESSION["userrole"] == "patient")
                            {echo "PatientPage.php";} 
			else
                            {echo "index.html";}?>">Home</a></li>
                    <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
            <img src="images/300x300.png" alt="Logo">
        </header>
        <h1>Update Personal Information</h1>
	    <form autocomplete="off">
        <label name="first">First Name: </label><input type="text" name="first">
        <label name="last">Last Name: </label><input type="text" name="last">
        <label name="birth">Date of Birth: </label><input type="text" name="birth" readonly><br><br>
        <label name="address">Address: </label><input type="text" name="Address"><br><br>
        <label name="city">City: </label><input type="text" name="city">
        <label name="state">State: </label><input type="text" name="state">
        <label name="zip">Zip: </label><input type="text" name="zip"><br><br>
        <label name="phone">Phone Number: </label><input type="text" name="phone">
        <label name="email">E-mail Address: </label><input type="text" name="email"><br><br>
        <input type="submit" value="Update"><br><br>
        </form>
		<!-- At this point much of the info will be filled out by the session variable-->
    </body>
</html>