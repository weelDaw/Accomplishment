<?php

session_start();
include "../DB/db_process.php";
$process = new db_process();

$username = $_POST['username'];
$password = md5($_POST['password']);
$pass = "";
$designation = "";
$user_id = "";


$id = $process->ck_users($username, $password);

while($data = $id->fetch()){
    $pass = $data[0];
    $user_id = $data[0];
    $designation = $data[3];

}
if($pass != "" && $pass != 0){
    $_SESSION['id'] = $user_id;
    $_SESSION['designation'] = $designation;
    $_SESSION['username'] = $username;
    echo "yes";
}else{
    echo "no";
}
