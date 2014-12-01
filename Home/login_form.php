<?php
session_start();
include "../Process/login/verification.php";
//include "../DB/db_con.php";
$membership = new LogVerify();
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $membership->log_User_Out();
}
if($_POST && !empty($_POST['log_uname']) && !empty($_POST['log_pass'])) {
    $response = $membership->validate_user($_POST['log_uname'], $_POST['log_pass']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Accomplishment</title>
    <link type="short icon" rel="short icon" href="../Images/project.png"/>
    <link type='text/css' rel='stylesheet' href='../bootstrap/css/bootstrap.css'>
    <link type='text/css' rel='stylesheet' href='../CSS/login.css'>
    <script type="text/javascript" src="../JS/jquery-1.9.1.min.js"></script>

    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.file-input.js"></script>
    <script type="text/javascript" src="../JS/main.js"></script>

</head>
<body>
<table class="tbl-login" id="login_tbl_ini">
    <form method="post" name="form1" id="porm">
    <tr>
        <th colspan="4"><img src="../Images/login_icon.jpg"></th>
    </tr>
    <tr>
        <td></td>
        <td>Username : </td>
        <td><input type="text" name="log_uname"/></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Password : </td>
        <td><input type="password" name="log_pass"/></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>
            &nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn btn-primary" id="sign_in" value="Sign In">
            &nbsp;&nbsp;&nbsp;
            <a class="btn" href="#reg_admin" data-toggle="modal">Register</a>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="4"><span id="err_msg_log"></span></td>
        <td></td>
    </tr>
</form>
    <tr>
        <td colspan="4"><?php if(isset($response)) echo "<h5 class='alerto'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $response . "</h5>"; ?></td>
    </tr>
</table>
<?php include "../Templates/modal.php"; ?>
<div id="open_registration"></div>
</body>
</html>