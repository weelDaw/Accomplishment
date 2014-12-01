<?php

include_once "../DB/db_process.php";
$sender = new db_process();

$tot_planned = "";
$tot_executed = 0;

$from = $_POST['from'];
$to = $_POST['to'];
$area = $_POST['area'];
$year = $_POST['year'];
$contract_id = $_POST['contract_id'];

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
        <th>Executed</th>
    </tr>
     <tr>
        <th><br/><br/>Planned<br/>Executed</th>
    </tr>
";

while($from <= $to){
    $tot_planned = 0;
    $tot_executed = 0;
    $days = cal_days_in_month(CAL_GREGORIAN,$from,$year);
    for($i = 1; $i <= $days; $i++){
        $date_format = $year."-".$from."-".$i;
        $date_format = date('Y-m-d', strtotime($date_format));

        $date_id = "";
        $ck_date = $sender->ck_date($date_format);
        while($d_date = $ck_date->fetch()){
            $date_id = $d_date[0];
        }
        $ck_plan = $sender->ck_exec_val($date_id, $contract_id, $area_id, "planned");
        while($data = $ck_plan->fetch()){
            if($data[0] == 0){

            }else{
                $ck_plan = $sender->ck_exec_get($date_id, $contract_id, $area_id, "planned");
                while($planned = $ck_plan->fetch()){
                    $tot_planned = $tot_planned + $planned[3];
                }
                $date_id2 = "";
                $ck_date2 = $sender->ck_date($date_format);
                while($d_date2 = $ck_date2->fetch()){
                    $date_id2 = $d_date2[0];
                }
                $ck_exec = $sender->ck_exec_val($date_id2, $contract_id, $area_id, "executed");
                while($data2 = $ck_exec->fetch()){
                    if($data2[0] != 0){
                        $ck_exec = $sender->ck_exec_get($date_id2, $contract_id, $area_id, "executed");
                        while($executed = $ck_exec->fetch()){
                            $tot_executed = $tot_executed + $executed[3];
                        }
                    }
                }
            }
        }
    }
    if($tot_planned != ""){
        echo "<tr>";
        echo "<th>".$month_arr[$from]."<br/>".$tot_planned."<br/>".$tot_executed."</th>";
        echo "<td>".$tot_planned."</td>";
        echo "<td>".$tot_executed."</td>";
        echo "</tr>";
    }
    $from++;
}
