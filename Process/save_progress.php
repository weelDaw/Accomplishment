<?php
include_once "../DB/db_process.php";
$sender = new db_process();
$plan = $_POST['plan_arr'];
$actual_arr = $_POST['actual_arr'];
$contract_price = $_POST['contract_price'];
$contract_id = $_POST['contract_id'];
$month = $_POST['month'];
$year = $_POST['year'];
$area = $_POST['area'];

$area_id = $sender->get_area_id($area);
while($area_id2 = $area_id->fetch()){
    $area = $area_id2[0];
}
echo $area;
$plan_ini = explode(",", $plan);
for($ctr = 0; $ctr < sizeof($plan_ini); $ctr++){
    if($plan_ini[$ctr] != ""){
        $per_piece = explode("-", $plan_ini[$ctr]);
        $value = $per_piece[0];
        $day = substr($per_piece[1], 12);
        $date_format = $year."-".$month."-".$day;
        $timestamp = strtotime($date_format);
        $timestamp = date( 'Y-m-d', $timestamp );
        $date_id = 0;
        $dates = $sender->ck_date_cnt($timestamp);
        while($des = $dates->fetch()){
            if($des[0] >= 1){
                $get_date = $sender->ck_date($timestamp);
                while($d_date = $get_date->fetch()){
                    $date_id = $d_date[0];
                }
            }else{
                $date_id = $sender->save_dates($timestamp);
            }
        }
        $ck_planned = $sender->ck_exec($contract_id, $date_id, $area, "prog_planned");
        while($ck = $ck_planned->fetch()){
            if($ck[0] != 0){
                $sender->update_exec($contract_id, $date_id, $value, $area, "prog_planned");
            }else{
                $sender->save_exec($contract_id, $date_id, $value, $area, "prog_planned");
            }
        }
    }
}

$actual_arr = explode(",", $actual_arr);
for($ctr = 0; $ctr < sizeof($actual_arr); $ctr++){
    if($actual_arr[$ctr] != ""){
        $per_piece2 = explode("-", $actual_arr[$ctr]);
        $value2 = $per_piece2[0];
        $day2 = substr($per_piece2[1], 11);
        $date_format2 = $year."-".$month."-".$day2;
        $timestamp2 = strtotime($date_format2);
        $timestamp2 = date( 'Y-m-d', $timestamp2 );
        $date_id2 = 0;
        $dates2 = $sender->ck_date_cnt($timestamp2);
        while($des2 = $dates2->fetch()){
            if($des2[0] >= 1){
                $get_date2 = $sender->ck_date($timestamp2);
                while($d_date2 = $get_date2->fetch()){
                    $date_id2 = $d_date2[0];
                }
            }else{
                $date_id2 = $sender->save_dates($timestamp2);
            }
        }
        $ck_exec = $sender->ck_exec($contract_id, $date_id2, $area, "prog_actual");
        while($ck = $ck_exec->fetch()){
            if($ck[0] != 0){
                $aha =$sender->update_exec($contract_id, $date_id2, $value2, $area, "prog_actual");
            }else{
                $sender->save_exec($contract_id, $date_id2, $value2, $area, "prog_actual");
            }
        }
    }
}


$date_format2 = $year."-".$month."-1";
$timestamp2 = strtotime($date_format2);
$timestamp2 = date( 'Y-m-d', $timestamp2 );
$date_id2 = 0;
$dates2 = $sender->ck_date_cnt($timestamp2);
while($des2 = $dates2->fetch()){
    if($des2[0] >= 1){
        $get_date2 = $sender->ck_date($timestamp2);
        while($d_date2 = $get_date2->fetch()){
            $date_id2 = $d_date2[0];
        }
    }else{
        $date_id2 = $sender->save_dates($timestamp2);
    }
}
$ck_exec = $sender->ck_exec($contract_id, $date_id2, $area, "prog_contract");
while($ck = $ck_exec->fetch()){
    if($ck[0] != 0){
        $aha =$sender->update_exec($contract_id, $date_id2, $contract_price, $area, "prog_contract");
    }else{
        $sender->save_exec($contract_id, $date_id2, $contract_price, $area, "prog_contract");
    }
}