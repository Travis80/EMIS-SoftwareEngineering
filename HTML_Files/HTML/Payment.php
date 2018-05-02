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
header img{
    margin:0;
    position:relative;
    top:10px;
    left:50%;
    margin-left:-150px;
}
div{
    position:relative;
    left:50%;
    top:2px;
}
form{
    position:relative;
    left:15%;
    top:5%;
    line-height: 1.7
}
form input[type="text"]{
    padding:0;
    height:30px;
    width:400px;
    font-size:13pt;
}
form input[type="submit"]{
    font-size:13pt;
    position: relative;
    top:10px;
}
body{
    margin:0;
    height:100%;
    font-family: "Arial", sans-serif;
}
html{
    height:100%;
    width:auto;
}    
    </style>
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
          <img src="images/300x300.png">
        </header>
        <form autocomplete="off">
        <section>Insurance Company:</section>
        <input type="text" name="insurance"><br>
        <section>Card Number:</section>
        <input type="text" name="card"><br>
        <section>Name on Card:</section>
        <input type="text" name="name"><br>
        <section>Month:</section>
        <input type="text" name="month"><br>
        <section>Year:</section>
        <input type="text" name="year"><br>
        <section>Billing Zip:</section>
        <input type="text" name="zip"><br>
        <input type="submit" value="Submit">
        </form>
    </body>
</html>