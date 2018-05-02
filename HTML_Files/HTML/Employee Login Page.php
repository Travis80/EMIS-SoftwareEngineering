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
}
form a:hover{
    text-decoration: underline;
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
    position:relative;
    left:44.5%;
}
form input[type="submit"]{
    height:25px;
    width:180px;
    padding:0;
    box-sizing:border-box;
    position:relative;
    left:44.5%;
    cursor:pointer;
}
form section{
    font-size:22px;
    position:relative;
    left:45%;
}
form span{
    position:relative;
    left:45%;
}
body{
    margin:0;
    height:100%;
    background-image:url("images/800px_COLOURBOX8565258.png");
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

	if(isset($_SESSION['emploginAttempt'])){
		if($_SESSION['emploginAttempt'] == 2){
			if(time() - $_SESSION['emplastLoginAttempt'] < 18000){
				 echo "Wait 10 minutes before next login attempt";
				 return;
			}
			else{
				$_SESSION['emploginAttempt'] = 0;
			}
		}
	}
	if($valid == true){
        $conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
	    if($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    echo "Connected successfully";
	    $sql = "SELECT username, password FROM Users WHERE username='$username' AND password='$password' AND userrole='nurse'"; /*This is the sql statement*/
	    $result = $conn->query($sql);
	    if(mysqli_num_rows($result)<1){
		/*$valid = false;
		$_SESSION['emploginAttempt'] ++;
		$_SESSION['emplastLoginAttempt'] = time();
		$usernameErr = "* Wrong username or password";
		$passwordErr = "* Wrong username or password";*/
	    }
	    else{
	    	if($valid == true ) {
		    $_SESSION['emploginAttempt'] = 0;
	            $_SESSION["userrole"] = "nurse";
	    	    $_SESSION["status"] = "Sign Out";
	       	    header('Location: NurseHome.php');
	    	}
	    }
	    $sql = "SELECT username, password FROM Users WHERE username='$username' AND password='$password' AND userrole='doctor'"; /*This is the sql statement*/
	    $result = $conn->query($sql);
	    if(mysqli_num_rows($result)<1){
		$valid = false;
		$usernameErr = "* Wrong username or password";
		$passwordErr = "* Wrong username or password";
	    }
	    else{
	    	if($valid == true ) {
		    $_SESSION["userrole"] = "doctor";
	    	    $_SESSION["status"] = "Sign Out";
	       	    header('Location: DoctorHome.php');
	    	}
	    }
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
                    <li><a href="<?php if($_SESSION["userrole"] == "nurse"){echo "NurseHome.php";} else{echo "index.html";}?>">Home</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
        <form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <section>Employee Portal</section>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>" placeholder="Employee ID">
	    <span class="error"><?php echo "$usernameErr";?></span>
	    <br>
            <input type="text" name="password"  value="<?php echo htmlspecialchars($password);?>" placeholder="Password">
	    <span class="error"><?php echo "$passwordErr";?></span>
	    <br>
            <input type="submit" value="Login">
            <br>
        </form>
        <footer>
            <small>EMIS Project 2018&copy</small>
        </footer>
    </body>
</html>