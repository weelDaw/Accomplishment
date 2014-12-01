<?php
include_once "../DB/db_process.php";
$sender = new db_process();
$desc = $_POST['desc'];
$project = $_POST['project'];
echo "<option></option>";
$get_areas = $sender->get_areas($project, $desc);
while($area = $get_areas->fetch()){
    $area_id = explode(",", $area[0]);
    for($i = 0; $i < sizeof($area_id); $i++){
        if($area_id[$i] != ""){
            $location = $sender->get_area2($area_id[$i]);
            while($data = $location->fetch()){
                echo "<option>".$data[1]."</option>";
//                echo "<option>".utf8_encode($data[1])."</option>";
            }
        }
    }
}