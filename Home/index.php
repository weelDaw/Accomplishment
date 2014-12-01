<?php
    include '../Process/login/verification.php';
    include_once '../DB/db_process.php';
    $sender = new db_process();
    $mem = new LogVerify();
    $mem->confirm_Member();
    $des = $_SESSION['designation'];
    $sub_des = ucfirst($des);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Accomplishment</title>
    <link type="short icon" rel="short icon" href="../Images/project.png"/>
    <link type='text/css' rel='stylesheet' href='../bootstrap/css/bootstrap.css'>
    <link type='text/css' rel='stylesheet' href='../bootstrap/css/bootstrap-datepicker.css'>
    <link type="text/css" rel="stylesheet" href="../CSS/all.css"/>
    <script type="text/javascript" src="../JS/jquery-1.9.1.min.js"></script>

<!--    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.file-input.js"></script>

    <script src="../JS/highcharts.js"></script>
    <script src="../JS/data.js"></script>
    <script src="../JS/exporting.js"></script>

    <script type="text/javascript" src="../JS/main.js"></script>
</head>
<body>
<div  class="loading">
    <img src='../Images/17.gif' class="image_loading"/>
</div>
<input type="text" value="<?php echo $_SESSION['designation']; ?>" id="designation_validate"/>
<?php include "../Templates/header.html"; ?>
<?php //include "../Templates/menu.php"; ?>
<br/>
<br/>
<br/>
<br/>
<br/>
<div id="container"></div>
<div id="open_per_piece">
    <?php include "per_piece.php"; ?>
</div>
<?php include "../Templates/modal.php"; ?>
<?php include "../Templates/footer.html"; ?>
</body>
</html>