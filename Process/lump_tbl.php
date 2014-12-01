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
    $save = "<tr><td><button class='btn btn-primary' onclick='get_lump()'>Save</button></td></tr>";
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

echo "<tr id='tr_lump_planned'>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "lump_planned");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "lump_planned");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='lump_planned".$i."' type='text' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_planned");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='lump_planned".$i."' type='text' value='".$planned[3]."' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_lump_sum'>";
echo "<td>Lump Sum:<br/> </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "lump_sum");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "lump_sum");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='lump_sum".$i."' type='text' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_sum");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='lump_sum".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_lump_ofs'>";
echo "<td>Out of Scope : </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "lump_ofs");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "lump_ofs");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='lump_ofs".$i."' type='text' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_ofs");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='lump_ofs".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_lump_penalty'>";
echo "<td>Penalty :<br/> </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "lump_penalty");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "lump_penalty");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='lump_penalty".$i."' type='text' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_penalty");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='lump_penalty".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation_lump(this.id)' onkeyup='sales_computation_lump(this.id)' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_sales'>";
echo "<td>Sales :<br/> </td>";
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
    $sum_val = 0;
    $ofs_val = 0;
    $penalty_val = 0;
    $sales = 0;

    if($area == "All"){
        $sum = $sender->ck_exec_get2($date_ini, $contract_id, "lump_sum");
        while($data1 = $sum->fetch()){
            $sum_val = $data1[0];
        }
        $ofs = $sender->ck_exec_get2($date_ini, $contract_id, "lump_ofs");
        while($data2 = $ofs->fetch()){
            $ofs_val = $data2[0];
        }
        $penalty = $sender->ck_exec_get2($date_ini, $contract_id, "lump_penalty");
        while($data3 = $penalty->fetch()){
            $penalty_val = $data3[0];
        }
    }else{
        $sum = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_sum");
        while($data1 = $sum->fetch()){
            $sum_val = $data1[3];
        }
        $ofs = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_ofs");
        while($data2 = $ofs->fetch()){
            $ofs_val = $data2[3];
        }
        $penalty = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "lump_penalty");
        while($data3 = $penalty->fetch()){
            $penalty_val = $data3[3];
        }
    }
    $sales = ($sum_val + $ofs_val) - $penalty_val;
    if($sales != 0){
        echo "<td id='sales2".$i."'>$sales</td>";
    }else{
        echo "<td id='sales2".$i."'></td>";
    }
}
echo "/<tr>";

echo $save;
$sender->close_connection();