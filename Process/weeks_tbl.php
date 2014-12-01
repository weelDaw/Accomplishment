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
    $save = "<tr><td><button class='btn btn-primary' onclick='get_plan()'>Save</button></td></tr>";
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

echo "<tr id='tr_planned'>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "planned");
     while($data = $ck_plan->fetch()){
         if($data[0] == 0){
             if($area == "All"){
                 $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "planned");
                 while($planned = $ck_plan->fetch()){
                     if($planned[0] == ""){
                         echo $empty;
                     }else{
                         echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                     }
                 }
             }else{
                 echo "<td><input id='plan".$i."' type='text' ".$disabled."/></td>";
             }
         }else{
             $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "planned");
             while($planned = $ck_plan->fetch()){
                 echo "<td><input id='plan".$i."' type='text' value='".$planned[3]."' ".$disabled."/></td>";
             }
         }
     }
}
echo "/<tr>";

echo "<tr id='tr_assigned'>";
echo "<td>Target / Assigned : </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "t_assigned");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "t_assigned");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='assigned".$i."' type='text' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "t_assigned");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='assigned".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_guaranteed'>";
echo "<td>Guaranteed : </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "guaranteed");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "guaranteed");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='guaranteed".$i."' type='text' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "guaranteed");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='guaranteed".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_executed'>";
echo "<td>Actual Executed : </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "executed");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "executed");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo  $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled></td>";
                    }
                }
            }else{
                echo "<td><input id='exec".$i."' type='text' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "executed");
            while($planned = $ck_plan->fetch()){
                    echo "<td><input id='exec".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_rates'>";
echo "<td>Rates : </td>";
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
    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_ini, "rates");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            if($area == "All"){
                $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "rates");
                while($planned = $ck_plan->fetch()){
                    if($planned[0] == ""){
                        echo $empty;
                    }else{
                        echo "<td><input type='text' value='".$planned[0]."' disabled/></td>";
                    }
                }
            }else{
                echo "<td><input id='rates".$i."' type='text' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }else{
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "rates");
            while($planned = $ck_plan->fetch()){
                echo "<td><input id='rates".$i."' type='text' value='".$planned[3]."' onkeydown='sales_computation(this.id)' onkeyup='sales_computation(this.id)' ".$disabled."/></td>";
            }
        }
    }
}
echo "/<tr>";

echo "<tr id='tr_sales'>";
echo "<td>Sales : </td>";
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
    $guarantee = "";
    $assign = "";
    $exec = "";
    $rat = "";
    $guaranteed_val = 0;
    $assigned_val = 0;
    $executed_val = 0;
    $rates_val = 0;
    $sales = 0;
    if($area == "All"){
        $guarantee = $sender->ck_exec_get2($date_ini, $contract_id, "guaranteed");
        $assign = $sender->ck_exec_get2($date_ini, $contract_id, "t_assigned");
        $exec = $sender->ck_exec_get2($date_ini, $contract_id, "executed");
        $rat = $sender->ck_exec_get2($date_ini, $contract_id, "rates");
        while($data1 = $guarantee->fetch()){
            $guaranteed_val = $data1[0];
        }
        while($data2 = $assign->fetch()){
            $assigned_val = $data2[0];
        }
        while($data3 = $exec->fetch()){
            $executed_val = $data3[0];
        }
        while($data4 = $rat->fetch()){
            $rates_val = $data4[0];
        }
    }else{
        $guarantee = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "guaranteed");
        $assign = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "t_assigned");
        $exec = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "executed");
        $rat = $sender->ck_exec_get($date_ini, $contract_id, $area_ini, "rates");
        while($data1 = $guarantee->fetch()){
            $guaranteed_val = $data1[3];
        }
        while($data2 = $assign->fetch()){
            $assigned_val = $data2[3];
        }
        while($data3 = $exec->fetch()){
            $executed_val = $data3[3];
        }
        while($data4 = $rat->fetch()){
            $rates_val = $data4[3];
        }
    }
    if($guaranteed_val < $assigned_val){
        $sales = $executed_val * $rates_val;
    }else{
        if($assigned_val == $executed_val){
            $sales = $guaranteed_val * $rates_val;
        }else{
            $sales = $executed_val * $rates_val;
        }
    }
    if($sales != 0){
        echo "<td id='sales".$i."'>$sales</td>";
    }else{
        echo "<td id='sales".$i."'></td>";
    }
}
echo "/<tr>";
echo $save;
$sender->close_connection();