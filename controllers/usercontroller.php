<?php
require_once '../models/account.php';
require_once '../controllers/DBcon.php';
require_once '../models/trans.php';
class usercontroller 
{
    protected $DB;
    public function addaccount(account $account){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $balance = rand(100,1000);
            $q1 = "SELECT * FROM account WHERE iban = '$account->iban' ";
            $result = $this -> DB->select($q1);
            if(count($result) == 0){
                $query = "INSERT INTO account VALUES ('','$account->user_id','$account->bank_id','$account->iban','$balance');";
                $result = $this -> DB->insert($query);
                if($result !== false){
                    $this->DB->closeconnection();
                    return true;
                }else{
                    $this->DB->closeconnection();
                    return false;
                }
            }
            
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function getaccounts(){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            
            $user_id = $_SESSION['user_id'];
            $query = "SELECT *
            FROM account
            JOIN user ON account.user_id = user.id
            JOIN banks ON account.bank_id = banks.id
            WHERE user_id = '$user_id'";
            $result = $this -> DB->select($query);
            
            if($result === false){
                echo "ERROR in query";
                $this->DB->closeconnection();
                return false;
            }
            else
            {
                return $result;
            }
            
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function sendmoney(trans $trans){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $q1 = "SELECT * FROM account WHERE iban = '$trans->sender_iban' ";
            $result = $this -> DB->select($q1);
            if( (int)$result[0]["Balance"] >=  (int)$trans->amount){
                $newbalance = (int)$result[0]["Balance"] -  (int)$trans->amount;
                $query = "UPDATE account SET Balance = '$newbalance' WHERE iban = $trans->sender_iban;";
                $result = $this -> DB->update($query);
                if($trans->rec_iban){
                    $q1 = "SELECT * FROM account WHERE iban = '$trans->rec_iban' ";
                    $result = $this -> DB->select($q1);
                    $newbalance = (int)$result[0]["Balance"] +  (int)$trans->amount;
                    $query = "UPDATE account SET Balance = '$newbalance' WHERE iban = $trans->rec_iban;";
                    $result = $this -> DB->update($query);
                    $query = "INSERT INTO trans VALUES(null, '$trans->sender_iban',$trans->rec_iban,'',$trans->amount,current_timestamp())";
                    $result = $this -> DB->update($query);
                }else{
                    $query = "INSERT INTO trans VALUES(null, '$trans->sender_iban','','$trans->rec_phone',$trans->amount,current_timestamp())";
                    
                    $result = $this -> DB->update($query);
                }
                
                
                if($result !== false){
                    $this->DB->closeconnection();
                    return true;
                }else{
                    $this->DB->closeconnection();
                    return false;
                }
            }
            else{
                return false;
            }
            
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function get_transforuser(user $user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {  

            $q1 = "SELECT *,userrec.firstName as recfirst,userrec.lastName as reclast FROM trans 
            join account ON sender_iban = iban
            join account as rectable ON rec_iban = rectable.iban
            join user as userrec ON rectable.user_id = userrec.id
            JOIN user ON account.user_id = user.id where user.id = '$user->id'";
            $result = $this -> DB->select($q1);
            return $result;
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function search_tranForUser($by,$substring,user $user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
            $q1 = "SELECT *,userrec.firstName as recfirst,userrec.lastName as reclast FROM trans 
            join account ON sender_iban = iban
            join account as rectable ON rec_iban = rectable.iban
            join user as userrec ON rectable.user_id = userrec.id
            JOIN user ON account.user_id = user.id
            WHERE ($by LIKE '%$substring%' OR userrec.lastName LIKE '%$substring%')
            AND (user.id =  $user->id) ";
            $result = $this -> DB->select($q1);
            return $result;
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