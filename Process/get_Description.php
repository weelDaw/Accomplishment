<?php
include_once "../DB/db_process.php";
$sender = new db_process();
$desc = $_POST['desc'];
$projects = $sender->get_description($desc);
echo "<option></option>";
while($data = $projects->fetch()){
    echo "<option>".$data[2]."</option>";
}