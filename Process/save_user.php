<?php

include "../DB/db_process.php";
$process = new db_process();

$designation = $_POST['designation'];
$user = $_POST['user'];
$password = md5($_POST['password']);

$id = $process->save_user($designation, $user, $password);

if($id != 0 || $id !=""){
    echo "yes";
}else{
    echo "no";
}