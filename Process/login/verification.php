<?php
include "C:/xampp/htdocs/Accomplishment/DB/db_process.php";

class LogVerify{

    function validate_user($un, $pwd) {
        $pro = new db_process();
        $design = "";
        $id = '';
        $password = md5($pwd);
        $ensure_credentials = $pro->verify_Username_and_Pass($un, $password);
        while($data = $ensure_credentials->fetch()){
            $id = $data[0];
            $design = $data[3];
        }
        if($id != 0 && $id != ""){
            $_SESSION['status'] = 'authorized';
            $_SESSION['designation'] = $design;
            $_SESSION['user_id'] = $id;
            header("location: ../Home/index.php");
        }else return "Username or Password is not correct !";
    }
    function log_User_Out() {
        if(isset($_SESSION['status'])) {
            unset($_SESSION['status']);

            if(isset($_COOKIE[session_name()]))
                setcookie(session_name(), '', time() - 1000);
            session_destroy();
        }
    }
    function confirm_Member() {
        session_start();
        if($_SESSION['status'] !='authorized') header("location:../Home/login_form.php");
    }
}