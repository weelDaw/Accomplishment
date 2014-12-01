<?php

include_once "../DB/db_process.php";
$sender = new db_process();

$tot_planned = 0;
$tot_executed = 0;
$show = "show";

$from = $_POST['from'];
$to = $_POST['to'];
$area = $_POST['area'];
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
        <th>Executed</th>
    </tr>
     <tr>
        <th><br/><br/>Planned<br/>Executed</th>
    </tr>
";

while(strtotime($from) <= strtotime($to)){
    $date_id = "";
    $ck_date = $sender->ck_date($from);
    while($d_date = $ck_date->fetch()){
        $date_id = $d_date[0];
    }
    $ck_plan = $sender->ck_exec_val($date_id, $contract_id, $area_id, "planned");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            $show = "hide";
        }else{
            $show = "show";
            $ck_plan = $sender->ck_exec_get($date_id, $contract_id, $area_id, "planned");
            while($planned = $ck_plan->fetch()){
                $tot_planned = $tot_planned + $planned[3];
            }
            $date_id2 = "";
            $ck_date2 = $sender->ck_date($from);
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
    if($show == "show"){
        echo "<tr>";
        echo "<th>".date('j', strtotime($from))."<br/>".$tot_planned."<br/>".$tot_executed."</th>";
        echo "<td>".$tot_planned."</td>";
        echo "<td>".$tot_executed."</td>";
        echo "</tr>";
    }
    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
}
$sender->close_connection();