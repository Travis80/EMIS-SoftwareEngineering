<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link href="Contact%20Us.css" rel="stylesheet">
</head>
    <body>
      <header>
            <nav>
                <ul>
                    <li><a href="<?php if($_SESSION["userrole"] == "patient"){echo "PatientPage.php";} else{echo "index.html";}?>">Home</a></li>
                   <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
        <h1>Contact Section</h1>
        <?php 
        $text = $valid = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST["text"])){
                $valid = false;
            }
            else{
                $valid = true;
                $text = $_POST['text'];
            }
            if($valid == true){
                $conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
                if($conn->connect_error){
                    die("Connection Failed: ". $conn->connect_error);
                }
                $sql = "INSERT INTO Contact (text) VALUES('$text')";
                $conn->query($sql);
                $valid = false;
            }
        }
        ?>
        <form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <section></section>
        <textarea name="text"><?php echo htmlspecialchars($text);?></textarea>
        <input type="submit" value="Send">
        </form>
    </body>
</html>