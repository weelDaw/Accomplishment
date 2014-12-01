<?php
session_start();
include_once "../DB/db_process.php";
$sender = new db_process();

$month_arr = array(
    "1" => "January",
    "2" => "February",
    "3" => "March",
    "4" => "April",
    "5" => "May",
    "6" => "June",
    "7" => "July",
    "8" => "August",
    "9" => "September",
    "10" => "October",
    "11" => "November",
    "12" => "December"
);
$contract_id = $_POST['contract_id'];
$month = $_POST['month'];
$year = $_POST['year'];
$area = $_POST['area'];
$user_id_holder = $_POST['user_id_holder'];

$save = "";
$disabled = "";
$empty = "<td><input type='text' disabled/></td>";

if($_SESSION['user_id'] == $user_id_holder && $area != "All"){
    $save = "<tr><td><button class='btn btn-primary' onclick='get_progress()'>Save</button></td></tr>";
}else{
    $disabled = "disabled";
}
/*======== Get Days from Specific Month and Year*/
$days = cal_days_in_month(CAL_GREGORIAN,$month,$year);

echo "<tr>";
echo "<th rowspan='2'>".$month_arr[$month]."</th>";
for($i = 1; $i <= $days; $i++){
    echo "<td>".$i."</td>";
}
echo "</tr>";

echo "<tr>";
for($i = 1; $i <= $days; $i++){
    $date = $year."-".$month."-".$i;
    $day = date('D', strtotime($date));
    $class = "";
    if($day == "Sun" || $day == "Sat"){
        $class = "red";
    }
    echo "<td class='$class'>".$day."</td>";
}
echo "/<tr>";

echo "<tr>";
echo "<td>Contract Price : </td>";
    $date_format = $year."-".$month."-1";
    $timestamp = strtotime($date_format);
    $timestamp = date( 'Y-m-d', $timestamp );
    $date_ini = "";
    $ck_date = $sender->ck_date($timestamp);
    while($d_date = $ck_date->fetch()){
        $date_ini = $d_date[0];
    }
    $area_ini = "";
    $ck_area = $sender->get_area($area);
    while($ck_area_ini = $ck_area->fetch()){
        $area_ini = $ck_area_ini[0];
    }
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "prog_contract");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "prog_contract");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td colspan='3'><input type='text' id='contract_price' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td colspan='3'><input type='text' id='contract_price' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "prog_contract");
            while($planned = $ck_plan->fetch()){
                echo "<td colspan='3'><input type='text' id='contract_price' value='".$planned[3]."' ".$disabled."/></td>";
            }
        }
}
echo "/<tr>";

echo "<tr id='tr_percent_plan'>";
echo "<td>Planned : </td>";
for($i = 1; $i <= $days; $i++){
    $date_format = $year."-".$month."-".$i;
    $timestamp = strtotime($date_format);
    $timestamp = date( 'Y-m-d', $timestamp );
    $date_ini = "";
    $ck_date = $sender->ck_date($timestamp);
    while($d_date = $ck_date->fetch()){
        $date_ini = $d_date[0];
    }
    $area_ini = "";
    $ck_area = $sender->get_area($area);
    while($ck_area_ini = $ck_area->fetch()){
        $area_ini = $ck_area_ini[0];
    }
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "prog_planned");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "prog_planned");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."%' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='prog_planned".$i."' type='text' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "prog_planned");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='prog_planned".$i."' type='text' value='".$planned[3]."' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_prog_actual'>";
echo "<td>Actual :<br/> </td>";
for($i = 1; $i <= $days; $i++){
    $date_format = $year."-".$month."-".$i;
    $timestamp = strtotime($date_format);
    $timestamp = date( 'Y-m-d', $timestamp );
    $date_ini = "";
    $ck_date = $sender->ck_date($timestamp);
    while($d_date = $ck_date->fetch()){
        $date_ini = $d_date[0];
    }
    $area_ini = "";
    $ck_area = $sender->get_area($area);
    while($ck_area_ini = $ck_area->fetch()){
        $area_ini = $ck_area_ini[0];
    }
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "prog_actual");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "prog_actual");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."%' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='prog_actual".$i."' type='text' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "prog_actual");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='prog_actual".$i."' type='text' value='".$planned[3]."' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";
echo $save;
$sender->close_connection();