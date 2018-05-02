<?php
session_start();

/*connects to database*/
$conn = new mysqli("localhost", "akmrt", "tft3546", "EMIS");
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*number of appointment*/
$sql = "SELECT * FROM Appointment";
$result = $conn->query($sql);
$num = mysqli_num_rows($result);
for($counter=0; $counter < $num; $counter++)
{
    $sql = "SELECT date FROM Appointment WHERE id=$counter";
    $result= $conn->query($sql);
    $appt[$counter] = $result->fetch_row()[0];
}
date_default_timezone_set("America/Chicago");

if(isset($_GET['ym']))
{
    $ym = $_GET['ym'];
} else {
 $ym = date('Y-m');
}

$timestamp = strtotime($ym, "-01");
if($timestamp === false) {
    $timestamp = time();
}

$today = date('Y-m-d', time());

$html_title = date('Y / m', $timestamp);

$prev = date('Y-m', mktime(0,0,0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0,0,0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

$day_count = date('t', $timestamp);

$str = date('w', mktime(0,0,0, date('m', $timestamp), 1, date('Y', $timestamp)));

$weeks = array();
$week = '';

$week .= str_repeat('<td></td>', $str);

/*goes through the entire month*/

for ( $day = 1; $day <= $day_count; $day++, $str++){
    $date = $ym.'-'.$day;
    $counter = 0;
    if($today == $date){
        $week .= '<td class="today"><a href="javascript:void(0)" onclick="toggle_visibility();">'.$day;
    }
    else if($appt[$counter] == $date){
        $week .='<td class="appointment">'.$day;
    }
    else{
        while($counter+1 < $num){
            $counter += 1;
            if($appt[$counter] == $date){
                $week .='<td class="appointment">'.$day;
                goto end;
            }
        }
        $week .= '<td><a href="javascript:void(0)" onclick="toggle_visibility();">'.$day; 
    }
    end:
    $week .= '</a></td>';
    
    if($str % 7 == 6 || $day == $day_count){
        if($day == $day_count){
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' .$week. '</tr>';
        $week = '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EMIS</title>
    <link rel="icon" href="images/Medical-Cross-Symbol.png" alt="ICON">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
     <link rel="stylesheet" href="AppointmentViewer.css">
</head>
     <header>
            <nav>
                <ul>
                    <li><a href="PersonalInfo.php"><?php echo $_SESSION["username"];?></a></li>
                    <li><a href="<?php if($_SESSION["userrole"] == "nurse"){echo "NurseHome.php";} elseif($_SESSION["userrole"] == "doctor"){echo "DoctorHome.php";}else{echo "index.html";}?>">Home</a></li>
                    <li><a href="Logout.php"><?php echo $_SESSION["status"];?></a></li>
                    <li><a href="About%20Page.html">About</a></li>
                </ul>
            </nav>
        </header>
    <h1>Appointments</h1>
    <body>
     <div id="popup" class="position">
        <div id="wrapper">
            <div id="popup-container">
                <p style="text-align: right;"><a href="javascript:void(0)" onclick="toggle_visibility();"><img src="images/Button_12-512.png"></a></p>
                <h2>Schedule Appointment</h2>
                <form>
                <section name="first">First Name: </section><input type="text" name="first" placeholder="First"><br><br>
                <section name="last">Last Name: </section><input type="text" name="last" placeholder="Last"><br><br>
                <section name="time">Time: </section><input type="text" name="time" placeholder="14:00"><br><br>
                <section name="description">Reason for Visit: </section><textarea name="description" placeholder="Description"></textarea><br>
                <input type="submit" value="Request Appointment"><br>
                </form>           
            </div>
        </div>
    </div>
<script type="text/javascript">
<!--
    function toggle_visibility() {
       var e = document.getElementById("popup");
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>
    <div class="container">
        <h3><a href= "?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href = "?ym=<?php echo $next; ?>">&gt;</a></h3><br>
            <table class="table table-bordered">
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>R</th>
                <th>F</th>
                <th>S</th>
            </tr>
            <?php
                foreach($weeks as $week){
                    echo $week;
            }
            ?>
            </table>
    </div>
        <button name="today"></button><section name="today">Today's Date</section>
        <button name="appointment"></button><section name="appt">Appointment Scheduled</section>
    </body>
</html>