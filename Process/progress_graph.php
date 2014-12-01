<?php

include_once "../DB/db_process.php";
$sender = new db_process();

$tot_planned = 0;
$tot_actual = 0;
$contract_price = 0;
$show = "show";

$from = $_POST['from'];
$to = $_POST['to'];
$area = $_POST['area'];
$month_ini = $_POST['month_ini'];
$year_ini = $_POST['year_ini'];
$contract_id = $_POST['contract_id'];

$area_id = "";
$ck_area = $sender->get_area($area);
while($ck_area_ini = $ck_area->fetch()){
    $area_id = $ck_area_ini[0];
}

$from = date('Y-m-d', strtotime($from));
$to = date('Y-m-d', strtotime($to));

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

$date_format = $year_ini."-".$month_ini."-1";
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
        if($area == "All"){
            $show = "show";
            $ck_plan = $sender->ck_exec_get2($date_ini, $contract_id, "prog_contract");
            while($planned = $ck_plan->fetch()){
                $contract_price = $planned[0];
            }
        }else{
            $show = "hide";
        }
    }else{
        $show = "show";
        $ck_plan = $sender->ck_exec_get($date_ini, $contract_id, $area_id, "prog_contract");
        while($planned = $ck_plan->fetch()){
            $contract_price = $planned[3];
        }
    }
}
if($show == "show"){
    while(strtotime($from) <= strtotime($to)){
        $date_id = "";
        $ck_date = $sender->ck_date($from);
        while($d_date = $ck_date->fetch()){
            $date_id = $d_date[0];
        }
        $ck_plan = $sender->ck_exec_val($date_id, $contract_id, $area_id, "prog_planned");
        while($data = $ck_plan->fetch()){
            if($data[0] == 0){
                if($area == "All"){
                    $ck_plan = $sender->ck_exec_get2($date_id, $contract_id, "prog_planned");
                    while($planned = $ck_plan->fetch()){
                        if($planned[0] != ""){
                            $show = "show";
                        }else{
                            $show = "hide";
                        }
                        $percent = $planned[0];
                        $length = strlen($percent);
                        if($length == 1){
                            $mult = "0.0".$percent;
                            $tot_planned = $contract_price * $mult;
                        }else if($length == 2){
                            $mult = "0.".$percent;
                            $tot_planned = $contract_price * $mult;
                        }else{
                            $tot_planned = $contract_price;
                        }
                    }
                    $sum = $sender->ck_exec_get2($date_id, $contract_id, "prog_actual");
                    while($data1 = $sum->fetch()){
                        $percent = $data1[0];
                        $length = strlen($percent);
                        if($length == 1){
                            $mult = "0.0".$percent;
                            $tot_actual = $contract_price * $mult;
                        }else if($length == 2){
                            $mult = "0.".$percent;
                            $tot_actual = $contract_price * $mult;
                        }else{
                            $tot_actual = $contract_price;
                        }
                    }
                }else{
                    $show = "hide";
                }
            }else{
                $show = "show";
                $ck_plan = $sender->ck_exec_get($date_id, $contract_id, $area_id, "prog_planned");
                while($planned = $ck_plan->fetch()){
                    $percent = $planned[3];
                    $percent = explode("%",$percent);
                    $length = strlen($percent[0]);
                    if($length == 1){
                        $mult = "0.0".$percent[0];
                        $tot_planned = $contract_price * $mult;
                    }else if($length == 2){
                        $mult = "0.".$percent[0];
                        $tot_planned = $contract_price * $mult;
                    }else{
                        $tot_planned = $contract_price;
                    }
                }
                $sum = $sender->ck_exec_get($date_id, $contract_id, $area_id, "prog_actual");
                while($data1 = $sum->fetch()){
                    $percent = $data1[3];
                    $percent = explode("%",$percent);
                    $length = strlen($percent[0]);
                    if($length == 1){
                        $mult = "0.0".$percent[0];
                        $tot_actual = $contract_price * $mult;
                    }else if($length == 2){
                        $mult = "0.".$percent[0];
                        $tot_actual = $contract_price * $mult;
                    }else{
                        $tot_actual = $contract_price;
                    }
                }
            }
        }
        if($show == "show"){
            echo "<tr>";
            echo "<th>".date('j', strtotime($from))."<br/>".$tot_planned."<br/>".$tot_actual."</th>";
            echo "<td>".$tot_planned."</td>";
            echo "<td>".$tot_actual."</td>";
            echo "</tr>";
        }
        $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
    }
}
$sender->close_connection();