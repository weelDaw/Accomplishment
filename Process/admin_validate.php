<?php

include "../DB/db_process.php";
$process = new db_process();

$u_name = $_POST['uname'];
$u_pass = md5($_POST['upass']);
$pass = "";

$id = $process->ck_administrator($u_name, $u_pass);

while($data = $id->fetch()){
    $pass = $data[0];
}
if($pass != "" && $pass != 0){
    echo "yes";
}else{
    echo "no";
}
