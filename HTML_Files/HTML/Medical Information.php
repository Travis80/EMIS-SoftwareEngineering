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
body{
    font-family: "Arial", sans-serif;
    margin:0;
    height:100%;
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
form input[name="height"]{
    position:relative;
    left:100px;
}
form input[name="weight"]{
    position:relative;
    left:101px;
}
form input[name="bloodType"]{
    position:relative;
    left:106px;
}
form input[name="allergies"]{
    position:relative;
    left:75px;
}
form input[name="medications"]{
    position:relative;
    left:50px;
}
form input[type="submit"]{
    font-size:15px;
}
html{
    height:100%;
}    
    </style>
</head>
    <body>
    <?php
    $height = $weight = $bloodType = $allergies = $medications = $valid = "";
    $heightErr = $weightErr = $bloodTypeErr = $allergiesErr = $medicationsErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
	if(empty($_POST["height"])) {
	    $heightErr = "* Required Field";
	    $valid = false;
	} else {
	    $height = test_input($_POST["height"]);
	    $valid = true;
	}

	if(empty($_POST["weight"])) {
	    $weightErr = "* Required Field";
	    $valid = false;
	} else {
	    $weight = test_input($_POST["weight"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	
	if(empty($_POST["bloodType"])) {
	    $bloodTypeErr = "* Required Field";
	    $valid = false;
	} else {
	    $bloodType = test_input($_POST["bloodType"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	
	if(empty($_POST["allergies"])) {
	    $allergiesErr = "* Required Field";
	    $valid = false;
	} else {
	    $allergies = test_input($_POST["allergies"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
	
	if(empty($_POST["medications"])) {
	    $medicationsErr = "* Required Field";
	    $valid = false;
	} else {
	    $medications = test_input($_POST["medications"]);
	    if($valid != true) {
		$valid = false;
	    }
	}
    

	if($valid == true)
	{
            $conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
	    if($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    echo "Connected successfully";
	    $username = $_SESSION["username"];
	    $sql = "INSERT INTO MedicalInfo (username, height, weight, bloodType, allergies, medications)
	    		VALUES ('$username', '$height', '$weight', '$bloodType', '$allergies', '$medications')";
	        if ($conn->query($sql) === TRUE) 
		{
    	    	    echo "Medical added correctly";
	        } else {
    	    	    echo "Medical Error: " . $sql . "<br>" . $conn->error;
	            die("Entry failed: " . $conn->error);
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
                    <li><a href="<?php if($_SESSION["userrole"] == "patient"){echo "PatientPage.php";} else{echo "index.html";}?>">Home</a></li>
                    <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
	
        

	<form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<section><h2>Enter Medical Information</h2></section>
	Height: <input type="text" name="height" value="<?php echo htmlspecialchars($height);?>" placeholder="5'5 ">
	<span class="error" name="f"><?php echo $heightErr;?></span>
        <br>
	Weight: <input type="text" name="weight" value="<?php echo htmlspecialchars($weight);?>" placeholder="170">
	<span class="error" name="f"><?php echo $weightErr;?></span>
        <br>
	Blood Type: <input type="text" name="bloodType" value="<?php echo htmlspecialchars($bloodType);?>" placeholder="ab">
	<span class="error" name="f"><?php echo $bloodTypeErr;?></span>
        <br>
        Allergies: <input type="text" name="allergies" value="<?php echo htmlspecialchars($allergies);?>" placeholder="Cedar, peanuts...">
	<span class="error" name="f"><?php echo $allergiesErr;?></span>
        <br>      
	Medications: <input type="text" name="medications" value="<?php echo htmlspecialchars($medications);?>" placeholder="medications">
	<span class="error" name="f"><?php echo $medicationsErr;?></span>
        <br>
	<input type="submit" name="submit" value="Submit">
	</form>
	<section>Upload Medical Information:</section>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="filetoUpload">
        <input type="submit" value="Upload">
	</form>

	<img src="images/utsa_logo.png" alt="UTSA Logo">
    </body>
</html>