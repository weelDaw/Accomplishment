<?php

include_once "../DB/db_process.php";
$sender = new db_process();

$tot_planned = 0;
$tot_sales = 0;
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
        <th>Sales</th>
    </tr>
     <tr>
        <th><br/><br/>Planned<br/>Sales</th>
    </tr>
";

while(strtotime($from) <= strtotime($to)){
    $date_id = "";
    $ck_date = $sender->ck_date($from);
    while($d_date = $ck_date->fetch()){
        $date_id = $d_date[0];
    }
    $ck_plan = $sender->ck_exec_val($date_id, $contract_id, $area_id, "lump_planned");
    while($data = $ck_plan->fetch()){
        if($data[0] == 0){
            $show = "hide";
        }else{
            $show = "show";
            $ck_plan = $sender->ck_exec_get($date_id, $contract_id, $area_id, "lump_planned");
            while($planned = $ck_plan->fetch()){
                $tot_planned = $tot_planned + $planned[3];
            }
               /* $date_ini = "";
                $ck_date = $sender->ck_date($from);
                while($d_date = $ck_date->fetch()){
                    $date_ini = $d_date[0];
                }
                $contract = "";
                $ck_contract = $sender->get_contract($project, $description);
                while($ck_con = $ck_contract->fetch()){
                    $contract = $ck_con[0];
                }
                $area_ini = "";
                $ck_area = $sender->get_area($area);
                while($ck_area_ini = $ck_area->fetch()){
                    $area_ini = $ck_area_ini[0];
                }*/
                $sum_val = 0;
                $ofs_val = 0;
                $penalty_val = 0;
                $sum = $sender->ck_exec_get($date_id, $contract_id, $area_id, "lump_sum");
                while($data1 = $sum->fetch()){
                    $sum_val = $data1[3];
                }
                $ofs = $sender->ck_exec_get($date_id, $contract_id, $area_id, "lump_ofs");
                while($data2 = $ofs->fetch()){
                    $ofs_val = $data2[3];
                }
                $penalty = $sender->ck_exec_get($date_id, $contract_id, $area_id, "lump_penalty");
                while($data3 = $penalty->fetch()){
                    $penalty_val = $data3[3];
                }
            $sub_sales = ($sum_val + $ofs_val) - $penalty_val;
            $tot_sales = $tot_sales + $sub_sales;
        }
    }
    if($show == "show"){
        echo "<tr>";
        echo "<th>".date('j', strtotime($from))."<br/>".$tot_planned."<br/>".$tot_sales."</th>";
        echo "<td>".$tot_planned."</td>";
        echo "<td>".$tot_sales."</td>";
        echo "</tr>";
    }
    $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
}
$sender->close_connection();