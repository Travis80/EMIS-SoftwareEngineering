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
header{
    height:150px;
}
form{
    margin:0;
    width:100%;
    height:auto;
    text-align:left;
    padding-left:100px;
    font-size:20px;
}
form input[type="text"]{
    width:300px;
    height:40px;
    box-sizing:border-box;
}
form input[name="first"]{
    position:relative;
    left:100px;
}
form input[name="last"]{
    position:relative;
    left:101px;
}
form input[name="username"]{
    position:relative;
    left:106px;
}
form input[name="email"]{
    position:relative;
    left:16px;
}
form input[name="password"]{
    position:relative;
    left:44px;
}
form input[name="confirm"]{
    position:relative;
    left:24px;
}
form input[name="birth"]{
    position:relative;
    left:33px;
}
form input[type="submit"]{
    font-size:15px;
}
form span[name="f"]{
    position:relative;
    left:100px;
}
form span[name="l"]{
    position:relative;
    left:101px;
}
form span[name="u"]{
    position:relative;
    left:105px;
}
form span[name="e"]{
    position:relative;
    left:15px;
}
form span[name="p"]{
    position:relative;
    left:45px;
}
form span[name="cp"]{
    position:relative;
    left:25px;
}
form span[name="dob"]{
    position:relative;
    left:34px;
}
form h2{
    line-height:0px;
}
body{
    margin:0;
    height:100%;
    font-family:"Arial", sans-serif;
}
html{
    height:100%;
}
    </style>
</head>
    <body>
    <?php
    $first = $last = $email = $password = $confirm = $birth = $gender = $username = $valid = "";
    $firstErr = $lastErr = $emailErr = $passwordErr = $confirmErr = $birthErr = $genderErr = $usernameErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["first"])) {
	    $firstErr = "* Required Field";
	    $valid = false;
	} else {
	    $first = test_input($_POST["first"]);
	    $valid = true;
	}

	if(empty($_POST["last"])) {
	    $lastErr = "* Required Field";
	    $valid = false;
	} else {
	    $last = test_input($_POST["last"]);
	    if($valid != true) {
		$valid = false;
	    }
	}

	if(empty($_POST["username"])) {
	    $usernameErr = "* Required Field";
	    $valid = false;
	} else {
	    $_SESSION["username"] = test_input($_POST["username"]);
	    $username = test_input($_POST["username"]);
	    if($valid != true) {
		$valid = false;
	    }
	}

	if(empty($_POST["email"])) {
	    $emailErr = "* Required Field";
	    $valid = false;
	} else {
	    $email = test_input($_POST["email"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $emailErr = "* Invalid email format";
	    $valid = false;
	}

	if(empty($_POST["password"])) {
	    $passwordErr = "* Required Field";
	    $valid = false;
	} else {
	    $password = test_input($_POST["password"]);
	    if($valid != true) {
		$valid = false;
	    }
	}

	if(empty($_POST["confirm"])) {
	    $confirmErr = "* Required Field";
	    $valid = false;
	} else {
	    $confirm = test_input($_POST["confirm"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	
	if($password !== $confirm) {
	    $passwordErr = "* Passwords do not match";
	    $valid = false;
	}

	if(empty($_POST["birth"])) {
	    $birthErr = "* Required Field";
	    $valid = false;
	} else {
	    $birth = test_input($_POST["birth"]);
	    if($valid != true) {
		$valid = false;
	    }
	}

	if(empty($_POST["gender"])) {
	    $genderErr = "* Required Field";
	    $valid = false;
	} else {
	    $gender = test_input($_POST["gender"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	if($valid == true){
            $conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
	    if($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    echo "Connected successfully";
	    $check = "SELECT username FROM Users WHERE username='$username'";
	    $result = $conn->query($check);
	    /*For some reason this condition is always true and when i try to print it doesn't work
		and I have no clue why. How do you compare it correctly because I know $result is
		an empty set*/
	    if(mysqli_num_rows($result)<1) {
		$r = hash('tiger192,3', $password, false);
	        $sql = "INSERT INTO Users (username, password, `userrole`)
	        VALUES ('$username', '$r', 'patient')";
	        if ($conn->query($sql) === TRUE) {
    	    	    echo "New record created successfully";
	        } else {
    	    	    echo "Error: " . $sql . "<br>" . $conn->error;
	            die("Entry failed: " . $conn->error);
	        }
		$sql = "INSERT INTO PatientInfo (username, firstname, lastname, email, dob, gender, phone, chartId)
	        VALUES ('$username', '$first', '$last', '$email', '$birth', '$gender', '210-xxx-xxxx', 'chart x')";
	        if ($conn->query($sql) === TRUE) {
    	    	    echo "Patient added correctly";
	        } else {
    	    	    echo "Patient Error: " . $sql . "<br>" . $conn->error;
	            die("Entry failed: " . $conn->error);
	        }
	        $_SESSION["status"] = "Sign Out";
	        header('Location: PatientPage.php');
	    } else {
		$usernameErr = "* username in use";
		$valid = false;
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
	    <form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <section><h2>Create An Account</h2></section>
	    First Name: <input type="text" name="first" value="<?php echo htmlspecialchars($first);?>" placeholder="John">
	    <span class="error" name="f"><?php echo $firstErr;?></span>
            <br>
            Last Name: <input type="text" name="last" value="<?php echo htmlspecialchars($last);?>" placeholder="Smith">
	    <span class="error" name="l"><?php echo $lastErr;?></span>
            <br>
	    Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>" placeholder="abc123">
	    <span class="error" name="u"><?php echo $usernameErr;?></span>
	    <br>
            Enter Email Address: <input type="text" name="email" value="<?php echo htmlspecialchars($email);?>" placeholder="john.smith@abc.net">
	    <span class="error" name="e"><?php echo $emailErr;?></span>
            <br>
            Create Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password);?>" placeholder="Password">
	    <span class="error" name="p"><?php echo $passwordErr;?></span>
            <br>
            Re-Enter Password: <input type="password" name="confirm" placeholder="Password">
	    <span class="error" name="cp"><?php echo $confirmErr;?></span>
            <br>
            Enter Date of Birth: <input type="date" name="birth" value="<?php echo htmlspecialchars($birth);?>" placeholder="MM/DD/YYYY">
	    <span class="error" name="dob"><?php echo $birthErr;?></span>
            <br>
            Activation Code: <input type="text" name="code">
            <br>
            <input type="radio" name="gender" value="male" checked> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other"> Other<br>
	    <span class="error">* <?php echo $genderErr;?></span>
            <br>
            <input type="submit" name="submit" value="Register">
        </form>
        <img src="images/utsa_logo.png" alt="UTSA Logo">
    </body>
</html>