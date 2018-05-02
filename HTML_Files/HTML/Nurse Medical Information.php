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
section{
    position: absolute;
    top:100px;
    left:30%;
    font-size:18pt;
}
form{
    position:absolute;
    top:140px;
    left:30%;
}
form input[type="submit"]{
    font-size:14pt;
    border-radius:20pt;
    background: white;
    border:solid 2px #008CBA;
}
form input[type="submit"]:hover{
    background-color: #008CBA;
    color:white;
}
form input[type="file"]{
    font-size:14pt;
}
form[title="info"]
{
    position:absolute;
    top:29%;
    font-size: 13pt;
    padding:0;
}
section[title="forms"]
{
    position:relative;
    top:17%;
    left:30%;
    font-size:18pt;
}
form input[name="blood"]
{
    width:30px;
}
form input[name="weight"]
{
    width:30px;
}
form textarea{
    position:relative;
    top:10px;
    width:400px;
    height:150px;
}
form label[name="condition"]{
    position:relative;
    top:-130px;
}
html{
    height:100%;
}    
    </style>
</head>
<?php
if($_SESSION["userrole"] != "nurse"){
header('Location: garbage.html');
}
?>
    <body>
      <header>
            <nav>
                <ul>
                    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="<?php if($_SESSION["userrole"] == "nurse"){echo "NurseHome.php";} else{echo "index.html";}?>">Home</a></li>
                    <li><a href="Logout.php">Sign Out</a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
        <section>Upload Medical Information:</section>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="filetoUpload">
        <input type="submit" value="Upload">
        </form>
        <section title="forms">Medical Form</section>
        <form autocomplete="off" title="info">
	    <label>Patient name(last, first):</label><input type="text" name="name">
            <label>Blood Type:</label><input type="text" name="blood">
            <label>Weight:</label><input type="text" name="weight"> lbs<br>
            <label>Date of Birth: </label><input type= "text" name="birth"><br>
            <label>Preferred Doctor:</label><input type="text" name="doctor"><br>
            <label>Insurance Company:</label><input type="text" name="insurance"><br>
            <label>Emergency Contact:</label><input type="text" name="emergencyname">
            <label>Emergency Contact Number:</label><input type="text" name="emergencyphone"><br>
            <label>Allergies:</label><br>
            <input type="checkbox" name="allergy" value="None" checked>None<br>
            <input type="checkbox" name="allergy" value="Animals">Animals<br>
            <input type="checkbox" name="allergy" value="Food">Food<br>
            <input type="checkbox" name="allergy" value="Insect Stings">Insect Stings<br>
            <input type="checkbox" name="allergy" value="Medicine/Drugs">Medicine/Drugs<br>
            <input type="checkbox" name="allergy" value="Plants">Plants<br>
            <input type="checkbox" name="allergy" value="Pollen">Pollen<br>
            <input type="checkbox" name="allergy" value="Other">Other<br>
            <label>Allergy Details:</label><input type="text" name="allergy"><br>
            <label name="condition">Previous Medical Condition(s): </label><textarea name="condition"></textarea><br><br>
            <label>Signature:</label><input type="text" name="signature">
            <label>Date:</label><input type="text" name="date">
            <input type="submit" value="Submit" title="btn"><br><br>
        </form>
              
    </body>
</html>