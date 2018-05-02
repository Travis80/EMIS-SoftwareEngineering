<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if($_SESSION["userrole"] == 'nurse'){
    header('Location: Nurse Medical Information.php');
}
if($_SESSION["userrole"] == 'patient'){
    header('Location: Medical Information.php');
}
?>
</body>
</html>