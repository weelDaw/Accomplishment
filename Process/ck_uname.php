<?php

include "../DB/db_process.php";
$process = new db_process();

$user = $_POST['user'];
$pass = "";

$id = $process->ck_uname($user);

while($data = $id->fetch()){
    $pass = $data[0];
}
if($pass != "" && $pass != 0){
    echo "no";
}else{
    echo "yes";
}
