<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <style>
	.error {
	    color: #FF0000;
	}
        form{
    margin: 0;
    width:100%;
    height:auto;
    text-align:left;
    line-height:2;
}
form a{
    text-decoration: none;
    color: blue;
    position: relative;
    left:44.6%;
}
form a:hover{
    text-decoration: underline;
    font-weight:bold;
}
header{
    margin:0;
    height:250px;
}
footer{
    position:absolute;
    bottom: 0;
    left: 5px;
    height:20px;
}
header nav{
    background:rgba(211,211,211,0.9);
    height:62px;
    box-shadow:0 0 10px rgba(0,0,0,0.25);
}
header nav ul{
    margin:0;
    list-style:none;
    padding:0;
    float:right;
    display:flex;
}
header nav ul li a{
    float:left;
    line-height:62px;
    padding: 0 15px;
    color:black;
    text-decoration: none;
    font-weight:650;
}
header nav ul li a:hover{
    font-weight: 900;
}
form input[type="text"]{
    width:180px;
    height:40px;
    padding:0;
    box-sizing:border-box;
    position: relative;
    left:43.5%;
}
form input[type="submit"]{
    height:25px;
    width:180px;
    padding:0;
    box-sizing:border-box;
    position:relative;
    left:43.5%;
    cursor:pointer;
}
form section{
    font-size:22px;
    position: relative;
    left:44.7%;
}
form span{
    position: relative;
    left:44%;
}
body{
    margin:0;
    height:100%;
    background-image: url("images/800px_COLOURBOX8565258.png");
    background-repeat: no-repeat;
    background-position: bottom left;
    font-family:"Arial", sans-serif;
}
html{
    height:100%;
}
    </style>
</head>
    <body>
    <?php
    $password = $username = $valid = "";
    $passwordErr = $usernameErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["username"])) {
	    $usernameErr = "* Required Field";
	    $valid = false;
	} else {
	    $_SESSION["username"] = test_input($_POST["username"]);
	    $username = test_input($_POST["username"]);
	    $valid = true;
	}

	if(empty($_POST["password"])) {
	    $passwordErr = "* Required Field";
	    $valid = false;
	} else {
	    $_SESSION["password"] = test_input($_POST["password"]);
	    $password = test_input($_POST["password"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
 	if(isset($_SESSION['loginAttempt'])){
		echo"{$_SESSION['loginAttempt']}";
		if($_SESSION['loginAttempt'] >= 3){
			if(time() - $_SESSION['lastLoginAttempt'] < 18000){
				 echo "Wait 10 minutes before next login attempt";
				 $_SESSION["userrole"] = "locked";
				 return;
			}
			else{
				$_SESSION['loginAttempt'] = 0;
			}
		}
	}
	if($valid == true){
            $conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
	    if($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    echo "Connected successfully";
	    $r = hash('tiger192,3', $password, false);
	    $sql = "SELECT username, password FROM Users WHERE username='$username' AND password='$r' AND userrole='patient'"; /*This is the sql statement*/
	    $result = $conn->query($sql);
	    if(mysqli_num_rows($result)<1){
		$_SESSION['loginAttempt'] ++;
		$_SESSION['lastLoginAttempt'] = time();
		$valid = false;
		$usernameErr = "* Wrong username or password";
		$passwordErr = "* Wrong username or password";
	    }
	    else{
	    	$_SESSION["userrole"] = "patient";
	    	$_SESSION["status"] = "Sign Out";
	    }
	}
	if($valid == true) {
	    $_SESSION['loginAttempt'] = 0;
	    
	    header('Location: PatientPage.php');
	}
    }
    function test_input($data) {
  	$data = trim($data);
 	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
    	return $data;
    }
    ?>
        <header>
            <nav>
                <ul>
                    <li><a href="<?php if($_SESSION["userrole"] == "patient"){echo "PatientPage.php";} else{echo "index.html";}?>">Home</a></li>
                    <li><a href="Employee%20Login%20Page.php">Employee</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
	<!-- Need to center the text fields on this so it lines up with the login button-->
        <form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    <section>Patient Portal</section>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>" placeholder="Username">
	    <span class="error"><?php echo "$usernameErr";?></span>
            <br>
            <input type="text" name="password" value="<?php echo htmlspecialchars($password);?>" placeholder="Password">
	    <span class="error"><?php echo "$passwordErr";?></span>
            <br>
            <input type="submit" value="Login">
            <br>
            <a href="Register.php">Register New User</a>
            <br>
            <a href="Forget%20Password.html">Forgot Password?</a>
        </form>
        <footer>
            <small>EMIS Project 2018&copy</small>
        </footer>
    </body>
</html>