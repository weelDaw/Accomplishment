<?php
session_start();
include_once "../DB/db_process.php";
$sender = new db_process();

$all = $sender->get_all();
while($data = $all->fetch()){
    $contract_ini = $data[5];
    $ca = "";
    $bill_ini = "";
    $project = "";
    $description = "";
    echo "<tr>";
    $contract = $sender->get_contract2($data[1]);
    while($data_con = $contract->fetch()){
        $ca = $data_con[3];
        $project = $data_con[1];
        $description = $data_con[2];
        echo "<td>".$data_con[3]."</td>";
        echo "<td>".$data[5]."</td>";
        echo "<td>".$data_con[1]."</td>";
        echo "<td>".$data_con[2]."</td>";
    }

    $view_bill = "";
    $billing = $sender->get_billing2($data[3]);
    while($data_bill = $billing->fetch()){
        $bill_ini = $data_bill[1];
        $view_bill = $view_bill.$data_bill[1]."<br/>";
    }

    $view_area = "";
    $area_exp = explode(",",$data[2]);
    echo "<td>";
    for($i = 0; $i < sizeof($area_exp); $i++){
        $area = $sender->get_area2($area_exp[$i]);
        while($data_area = $area->fetch()){
            $view_area = $view_area.$data_area[1];
            echo "<a id='".$ca.",".$contract_ini.",".$project.','.$description.','.$data_area[1].",".$bill_ini.",".$data[0].",".$data[4]."' onclick='billing_action(this.id)'>".$data_area[1]."</a><br/>";
        }
    }
    echo "<a id='".$ca.",".$contract_ini.",".$project.','.$description.',All,'.$bill_ini.",".$data[0].",".$data[4]."' onclick='billing_action(this.id)'>( All )</a>";
    echo "</td>";
    echo "<td>".$view_bill."</td>";
    echo "</tr>";
}