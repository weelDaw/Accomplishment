<?php
session_start();
include_once "../DB/db_process.php";
$sender = new db_process();

$ca = $_POST["ca"];
$project = $_POST["project"];
$contract = $_POST["con"];
$description = $_POST["desc"];
$area = $_POST["area"];
$billing = $_POST["billing"];

$con_id = 0;
$area_id = 0;
$billing_id = 0;
$area_id_arr = "";

$get_con = $sender->get_contract($project, $description, $ca);
while($data = $get_con->fetch()){
    $con_id = $data[0];
}
if($con_id == 0){
    $con_id = $sender->reg_project($project, $description, $ca);
}
$area_arr = explode(",", $area);
for($ctr = 0; $ctr < sizeof($area_arr); $ctr++){
    $area_id = 0;
    if($area_arr[$ctr] != ""){
        $get_area = $sender->get_area($area_arr[$ctr]);
        while($data_area = $get_area->fetch()){
            $area_id = $data_area[0];
            if($area_id_arr == ""){
                $area_id_arr = $area_id;
            }else{
                $area_id_arr = $area_id_arr.",".$area_id;
            }
        }
        if($area_id == 0){
            $area_id = $sender->save_area($area_arr[$ctr]);
            if($area_id_arr == ""){
                $area_id_arr = $area_id;
            }else{
                $area_id_arr = $area_id_arr.",".$area_id;
            }
        }
    }
}
$get_billing = $sender->get_billing($billing);
while($data_billing = $get_billing->fetch()){
    $billing_id = $data_billing[0];
}
if($billing_id == 0){
    $billing_id = $sender->save_billing($billing);
}
$save_contract = $sender->save_contract($con_id, $area_id_arr, $billing_id, $_SESSION['user_id'], $contract);
echo "Successfully saved !";


