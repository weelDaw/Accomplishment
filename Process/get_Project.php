<?php
include_once "../DB/db_process.php";
$sender = new db_process();

$billing = $_POST['billing'];
$bill_id = '';

switch($billing){
    case "Per Piece":
        $bill_id = 1;
        break;
    case "Crew Type":
        $bill_id = 2;
        break;
    case "Lump Sum":
        $bill_id = 3;
        break;
    case "Progress":
        $bill_id = 4;
        break;
    case "Cost +":
        $bill_id = 5;
        break;
}


$arr_id = array();

$get_contracts = $sender->get_all();
echo "<option></option>";
while($con = $get_contracts->fetch()){
    $billing_arr = explode(",", $con[3]);
    for($ctr = 0; $ctr < sizeof($billing_arr); $ctr++){
        if($billing_arr[$ctr] == $bill_id){
            $projects = $sender->sel_projects($con[1]);
            while($data = $projects->fetch()){
                array_push($arr_id, $data[0]);
            }
        }
    }
}
$arr_id = array_unique($arr_id, SORT_REGULAR);
for($ct = 0; $ct < sizeof($arr_id); $ct++){
    echo "<option>".$arr_id[$ct]."</option>";
}
