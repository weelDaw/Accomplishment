<?php
include_once "../DB/db_process.php";
$sender = new db_process();
$plan_arr = $_POST['plan_arr'];
$sum_arr = $_POST['sum_arr'];
$ofs_arr = $_POST['ofs_arr'];
$penalty = $_POST['penalty'];
$contract_id = $_POST['contract_id'];
$month = $_POST['month'];
$year = $_POST['year'];
$area = $_POST['area'];

$area_id = $sender->get_area_id($area);
while($area_id2 = $area_id->fetch()){
    $area = $area_id2[0];
}
echo $area;
$plan_ini = explode(",", $plan_arr);
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
        $ck_planned = $sender->ck_exec($contract_id, $date_id, $area, "lump_planned");
        while($ck = $ck_planned->fetch()){
            if($ck[0] != 0){
                $sender->update_exec($contract_id, $date_id, $value, $area, "lump_planned");
            }else{
                $sender->save_exec($contract_id, $date_id, $value, $area, "lump_planned");
            }
        }
    }
}

$exec_ini = explode(",", $sum_arr);
for($ctr = 0; $ctr < sizeof($exec_ini); $ctr++){
    if($exec_ini[$ctr] != ""){
        $per_piece2 = explode("-", $exec_ini[$ctr]);
        $value2 = $per_piece2[0];
        $day2 = substr($per_piece2[1], 8);
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
        $ck_exec = $sender->ck_exec($contract_id, $date_id2, $area, "lump_sum");
        while($ck = $ck_exec->fetch()){
            if($ck[0] != 0){
                $aha =$sender->update_exec($contract_id, $date_id2, $value2, $area, "lump_sum");
            }else{
                $sender->save_exec($contract_id, $date_id2, $value2, $area, "lump_sum");
            }
        }
    }
}

$target_ini = explode(",", $ofs_arr);
for($ctr = 0; $ctr < sizeof($target_ini); $ctr++){
    if($exec_ini[$ctr] != ""){
        $per_piece2 = explode("-", $target_ini[$ctr]);
        $value2 = $per_piece2[0];
        $day2 = substr($per_piece2[1], 8);
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
        $ck_exec = $sender->ck_exec($contract_id, $date_id2, $area, "lump_ofs");
        while($ck = $ck_exec->fetch()){
            if($ck[0] != 0){
                $aha =$sender->update_exec($contract_id, $date_id2, $value2, $area, "lump_ofs");
            }else{
                $sender->save_exec($contract_id, $date_id2, $value2, $area, "lump_ofs");
            }
        }
    }
}

$guaranteed_ini = explode(",", $penalty);
for($ctr = 0; $ctr < sizeof($guaranteed_ini); $ctr++){
    if($exec_ini[$ctr] != ""){
        $per_piece2 = explode("-", $guaranteed_ini[$ctr]);
        $value2 = $per_piece2[0];
        $day2 = substr($per_piece2[1], 12);
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
    }
    $ck_exec = $sender->ck_exec($contract_id, $date_id2, $area, "lump_penalty");
    while($ck = $ck_exec->fetch()){
        if($ck[0] != 0){
            $aha =$sender->update_exec($contract_id, $date_id2, $value2, $area, "lump_penalty");
        }else{
            $sender->save_exec($contract_id, $date_id2, $value2, $area, "lump_penalty");
        }
    }
}

