<?php
require_once '../controllers/DBcon.php';
require_once '../models/trans.php';
class transcontroller 
{
    protected $DB;
    public function get_collect(){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
            $user_id = $_SESSION["user_id"];
            $q1 = "SELECT * FROM user WHERE id = '$user_id' ";
            $result = $this -> DB->select($q1);
            $phone = $result[0]["phone"];
            $query = "SELECT * FROM trans WHERE rec_phone = '$phone' AND rec_iban = '0' ";
            $result = $this -> DB->select($query);
            return $result;
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function collect_money(trans $trans){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query = "UPDATE trans SET rec_iban = '$trans->rec_iban' WHERE id = $trans->id;";
            $result = $this -> DB->update($query);
            $q1 = "SELECT * FROM account WHERE iban = '$trans->rec_iban' ";
            $result = $this -> DB->select($q1);
            $q2 = "SELECT * FROM trans WHERE id = $trans->id; ";
            $result2 = $this -> DB->select($q2);
            $newbalance = (int)$result[0]["Balance"] +  (int)$result2[0]["amount"];
            $query = "UPDATE account SET Balance = '$newbalance' WHERE iban = $trans->rec_iban;";
            $result = $this -> DB->update($query);
            
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
}
?>