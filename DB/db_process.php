<?php

include "db_con.php";

class db_process extends sql{

    public function __construct(){
        $this -> open_con();
    }
    public function close_connection(){
        $this -> close_con();
    }

    public function verify_Username_and_Pass($user, $pass){
        $stmt =$this->db_con->prepare("SELECT *
                                       FROM users
                                       WHERE u_name = ?
                                       AND u_pass = ?");
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $pass);
        $stmt->execute();
        return $stmt;
    }
    public function save_user($designation, $user, $password){
        $stmt = $this->db_con->prepare("INSERT INTO users(u_name, u_pass, designation)
                                               VALUES(?, ?, ?)");
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $designation);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
    public function ck_uname($uname){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM users
                                        WHERE u_name = ?");
        $stmt->bindParam(1, $uname);
        $stmt->execute();
        return $stmt;
    }
    public function ck_users($username, $password){
        $stmt = $this->db_con->prepare("SELECT * FROM users
                                        WHERE u_name = ?
                                        AND u_pass = ?");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        return $stmt;
    }
    public function ck_administrator($u_name, $u_pass){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM users
                                        WHERE u_name = ?
                                        AND u_pass = ?
                                        AND designation = 'Administrator'");
        $stmt->bindParam(1, $u_name);
        $stmt->bindParam(2, $u_pass);
        $stmt->execute();
        return $stmt;
    }

    public function reg_project($contract, $description, $ca){
        $stmt = $this->db_con->prepare("INSERT INTO reg_project(contract, description, ca)
                                               VALUES(?, ?, ?)");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $ca);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
    public function save_area($area){
        $stmt = $this->db_con->prepare("INSERT INTO proj_area(area_name)
                                               VALUES(?)");
        $stmt->bindParam(1, $area);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
    public function save_billing($billing){
        $stmt = $this->db_con->prepare("INSERT INTO billing(billing_type)
                                               VALUES(?)");
        $stmt->bindParam(1, $billing);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
    public function save_contract($con_id, $area_id, $billing_id, $user_id, $contract){
        $stmt = $this->db_con->prepare("INSERT INTO contract(con_id, area_id, billing_id, user_id, contract)
                                               VALUES(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $con_id);
        $stmt->bindParam(2, $area_id);
        $stmt->bindParam(3, $billing_id);
        $stmt->bindParam(4, $user_id);
        $stmt->bindParam(5, $contract);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
    public function get_contract($contract, $description, $ca){
        $stmt = $this->db_con->prepare("SELECT * FROM reg_project
                                        WHERE contract = ? AND description = ? AND ca = ?");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $ca);
        $stmt->execute();
        return $stmt;
    }
    public function get_contract2($id){
        $stmt = $this->db_con->prepare("SELECT * FROM reg_project
                                        WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
    public function get_area($area){
        $stmt = $this->db_con->prepare("SELECT * FROM proj_area
                                        WHERE area_name = ?");
        $stmt->bindParam(1, $area);
        $stmt->execute();
        return $stmt;
    }
    public function get_area2($id){
        $stmt = $this->db_con->prepare("SELECT * FROM proj_area
                                        WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
    public function get_billing($billing){
        $stmt = $this->db_con->prepare("SELECT * FROM billing
                                        WHERE billing_type = ?");
        $stmt->bindParam(1, $billing);
        $stmt->execute();
        return $stmt;
    }
    public function get_billing2($id){
        $stmt = $this->db_con->prepare("SELECT * FROM billing
                                        WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
        public function get_all(){
        $stmt = $this->db_con->prepare("SELECT * FROM contract");
        $stmt->execute();
        return $stmt;
    }
    public function get_projects(){
        $stmt = $this->db_con->prepare("SELECT DISTINCT(contract) FROM reg_project");
        $stmt->execute();
        return $stmt;
    }
    public function sel_projects($id){
        $stmt = $this->db_con->prepare("SELECT contract FROM reg_project WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
    public function get_description($des){
        $stmt = $this->db_con->prepare("SELECT * FROM reg_project WHERE contract = ?");
        $stmt->bindParam(1, $des);
        $stmt->execute();
        return $stmt;
    }
    public function ck_date($date){
        $stmt = $this->db_con->prepare("SELECT id FROM dates WHERE d_dates = ?");
        $stmt->bindParam(1, $date);
        $stmt->execute();
        return $stmt;
    }
    public function ck_date_cnt($date){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM dates WHERE d_dates = ?");
        $stmt->bindParam(1, $date);
        $stmt->execute();
        return $stmt;
    }
    public function save_dates($date){
        $stmt = $this->db_con->prepare("INSERT INTO dates(d_dates)
                                               VALUES(?)");
        $stmt->bindParam(1, $date);
        $stmt->execute();
        $id = $this->db_con->lastInsertId();
        return $id;
    }
   /* public function ck_planned($con_id, $date_id, $area_id){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM planned WHERE con_id = ? AND p_date = ? AND area_id = ?");
        $stmt->bindParam(1, $con_id);
        $stmt->bindParam(2, $date_id);
        $stmt->bindParam(3, $area_id);
        $stmt->execute();
        return $stmt;
    }*/
    public function ck_exec($con_id, $date_id, $area_id, $table_ini){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM $table_ini WHERE con_id = ? AND date_id = ? AND area_id = ?");
        $stmt->bindParam(1, $con_id);
        $stmt->bindParam(2, $date_id);
        $stmt->bindParam(3, $area_id);
        $stmt->execute();
        return $stmt;
    }
   /* public function save_planned($con_id, $date_id, $value, $area_id){
        $stmt = $this->db_con->prepare("INSERT INTO planned(con_id, p_date, planned, area_id)
                                               VALUES(?, ?, ?, ?)");
        $stmt->bindParam(1, $con_id);
        $stmt->bindParam(2, $date_id);
        $stmt->bindParam(3, $value);
        $stmt->bindParam(4, $area_id);
        $stmt->execute();
        return $stmt;
    }*/
    public function save_exec($con_id, $date_id, $value, $area_id, $table_ini){
        $stmt = $this->db_con->prepare("INSERT INTO $table_ini(con_id, date_id, executed, area_id)
                                               VALUES(?, ?, ?, ?)");
        $stmt->bindParam(1, $con_id);
        $stmt->bindParam(2, $date_id);
        $stmt->bindParam(3, $value);
        $stmt->bindParam(4, $area_id);
        $stmt->execute();
        return $stmt;
    }
   /* public function update_planned($con_id, $date_id, $value, $area_id){
        $stmt = $this->db_con->prepare("UPDATE planned SET planned = ? WHERE con_id = ? AND p_date = ? AND area_id = ?");
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $con_id);
        $stmt->bindParam(3, $date_id);
        $stmt->bindParam(4, $area_id);
        $stmt->execute();
        return $stmt;
    }*/
    public function update_exec($con_id, $date_id, $value, $area_id, $table_ini){
        $stmt = $this->db_con->prepare("UPDATE $table_ini SET executed = ? WHERE con_id = ? AND date_id = ? AND area_id = ?");
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $con_id);
        $stmt->bindParam(3, $date_id);
        $stmt->bindParam(4, $area_id);
        $stmt->execute();
//        return $stmt;
        return $value;
    }
    public function get_areas($contract, $description){
        $stmt = $this->db_con->prepare("SELECT con.area_id FROM reg_project As reg, contract As con
                                        WHERE reg.contract = ?
                                        AND reg.description = ?
                                        AND reg.id = con.con_id");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $description);
        $stmt->execute();
        return $stmt;
    }
    public function get_area_id($area){
        $stmt = $this->db_con->prepare("SELECT id FROM proj_area WHERE area_name = ?");
        $stmt->bindParam(1, $area);
        $stmt->execute();
        return $stmt;
    }
    /*public function ck_plan_val($date_ini, $contract, $area_ini){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM planned
                                        WHERE con_id = ?
                                        AND p_date = ?
                                        AND area_id = ?
                                        ");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $date_ini);
        $stmt->bindParam(3, $area_ini);
        $stmt->execute();
        return $stmt;
    }*/
    public function ck_exec_val($date_ini, $contract, $area_ini, $table){
        $stmt = $this->db_con->prepare("SELECT COUNT(id) FROM $table
                                        WHERE con_id = ?
                                        AND date_id = ?
                                        AND area_id = ?
                                        ");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $date_ini);
        $stmt->bindParam(3, $area_ini);
        $stmt->execute();
        return $stmt;
    }
   /* public function ck_plan_val2($date_ini, $contract, $area_ini){
        $stmt = $this->db_con->prepare("SELECT * FROM planned
                                        WHERE con_id = ?
                                        AND date_ini = ?
                                        AND area_id = ?
                                        ");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $date_ini);
        $stmt->bindParam(3, $area_ini);
        $stmt->execute();
        return $stmt;
    }*/
    public function ck_exec_get($date_ini, $contract, $area_ini, $table){
        $stmt = $this->db_con->prepare("SELECT * FROM $table
                                        WHERE con_id = ?
                                        AND date_id = ?
                                        AND area_id = ?
                                        ");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $date_ini);
        $stmt->bindParam(3, $area_ini);
        $stmt->execute();
        return $stmt;
    }
    public function ck_exec_get2($date_ini, $contract, $table){
        $stmt = $this->db_con->prepare("SELECT SUM(executed) AS total FROM $table
                                        WHERE con_id = ?
                                        AND date_id = ?
                                        ");
        $stmt->bindParam(1, $contract);
        $stmt->bindParam(2, $date_ini);
        $stmt->execute();
        return $stmt;
    }
}