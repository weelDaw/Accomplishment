<?php

include_once "../DB/db_process.php";
$sender = new db_process();

$tot_planned = "";
$tot_actual = "";
$contract_price = 0;

$contract_id = $_POST['contract_id'];
$from = $_POST['from'];
$to = $_POST['to'];
$area = $_POST['area'];
$year = $_POST['year'];

$month_arr = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

$area_id = "";
$ck_area = $sender->get_area($area);
while($ck_area_ini = $ck_area->fetch()){
    $area_id = $ck_area_ini[0];
}

echo "
     <tr>
        <th></th>
        <th>Planned</th>
        <th>Actual</th>
    </tr>
     <tr>
        <th><br/><br/>Planned<br/>Actual</th>
    </tr>
";

while($from <= $to){

    $contract_price = 0;

    $date_format = $year."-".$from."-1";
    $timestamp = strtotime($date_format);
    $timestamp = date( 'Y-m-d', $timestamp );
    $date_ini = "";
    $ck_date = $sender->ck_date($timestamp);
    while($d_date = $ck_date->fetch()){
        $date_ini = $d_date[0];
    }

    $ck_plan = $sender->ck_exec_val($date_ini, $contract_id, $area_id, "prog_contract");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            $show = "hide";
        }else{
            $show = "show";
            $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_id, "prog_contract");
            while($planned = $ck_plan->fetch()){
                $contract_price = $planned[3];
            }
        }
    }
    if($show == "show"){
        $tot_planned = 0;
        $tot_actual = 0;
        $days = cal_days_in_month(CAL_GREGORIAN,$from,$year);
        for($i = 1; $i <= $days; $i++){
            $date_format = $year."-".$from."-".$i;
            $date_format = date('Y-m-d', strtotime($date_format));

            $date_id = "";
            $ck_date = $sender->ck_date($date_format);
            while($d_date = $ck_date->fetch()){
                $date_id = $d_date[0];
            }
            $ck_plan = $sender->ck_exec_val($date_id, $contract_id, $area_id, "prog_planned");
            while($data = $ck_plan->fetch()){
                if($data[0] == 0){

                }else{
                    $ck_plan = $sender->ck_exec_get($date_id, $contract_id, $area_id, "prog_planned");
                    while($planned = $ck_plan->fetch()){
                        $percent = $planned[3];
                        $percent = explode("%",$percent);
                        $length = strlen($percent[0]);
                        if($length == 1){
                            $mult = "0.0".$percent[0];
                            $sub = $contract_price * $mult;
                            $tot_planned = $tot_planned + $sub;
                        }else if($length == 2){
                            $mult = "0.".$percent[0];
                            $sub = $contract_price * $mult;
                            $tot_planned = $tot_planned + $sub;
                        }else{
                            $tot_planned = $contract_price;
                        }
                    }
                    /*$date_id2 = "";
                    $ck_date2 = $sender->ck_date($date_format);
                    while($d_date2 = $ck_date2->fetch()){
                        $date_id2 = $d_date2[0];
                    }*/

                   /* $contract = "";
                    $ck_contract = $sender->get_contract($project, $description);
                    while($ck_con = $ck_contract->fetch()){
                        $contract = $ck_con[0];
                    }*/
                    /*$area_ini = "";
                    $ck_area = $sender->get_area($area);
                    while($ck_area_ini = $ck_area->fetch()){
                        $area_ini = $ck_area_ini[0];
                    }*/
                    $sum = $sender->ck_exec_get($date_id, $contract_id, $area_id, "prog_actual");
                    while($data1 = $sum->fetch()){
                        $percent = $data1[3];
                        $percent = explode("%",$percent);
                        $length = strlen($percent[0]);
                        if($length == 1){
                            $mult = "0.0".$percent[0];
                            $sub_t = $contract_price * $mult;
                            $tot_actual = $tot_actual + $sub_t;
                        }else if($length == 2){
                            $mult = "0.".$percent[0];
                            $sub_t = $contract_price * $mult;
                            $tot_actual = $tot_actual + $sub_t;
                        }else{
                            $tot_actual = $contract_price;
                        }
                    }
                }
            }
        }
        if($tot_planned !=""){
            echo "<tr>";
            echo "<th>".$month_arr[$from]."<br/>".$tot_planned."<br/>".$tot_actual."</th>";
            echo "<td>".$tot_planned."</td>";
            echo "<td>".$tot_actual."</td>";
            echo "</tr>";
        }
    }
    $from++;
}
