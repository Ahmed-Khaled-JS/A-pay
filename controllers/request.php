<?php
require_once '../models/account.php';
require_once '../controllers/DBcon.php';
require_once '../models/request.php';
require_once '../models/user.php';

class requestcon 
{
    protected $DB;
    public function sendrequest(REQUEST $request){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query =  "INSERT INTO request VALUES(null ,$request->sender_id,$request->rec_phone,$request->amount, current_timestamp(),$request->rec_id,0)";
            $result = $this -> DB->insert($query);
            
            if($result === false){
                echo "ERROR in query";
                $this->DB->closeconnection();
                return false;
            }
            else
            {
                return true;
            }
            
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }
    public function get_requests($user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query =  "SELECT *,request.id as hamada FROM request JOIN user ON sender_id = user.id WHERE rec_id = $user And acc =0";
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
    public function getDetailsByphone($phone){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query =  "SELECT * FROM user WHERE phone = $phone";
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
    public function updaterequest(REQUEST $request,account $account){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {   
            print_r($request);
            
            print_r($account);
            $q1 = "SELECT * FROM account WHERE iban = '$account->iban' ";
            $result = $this -> DB->select($q1);
            if($request->acc == "1"){
                print_r($request);
            
                print_r($account);
                print_r($result);
                if((int)$result[0]["Balance"] >= $request->amount){
                    $newbalance = (int)$result[0]["Balance"] -  $request->amount; 
                    $query = "UPDATE account SET Balance = '$newbalance' WHERE iban = $account->iban;";
                    $result = $this -> DB->update($query);
                }else{
                    return false;
                }
                
           
            }
            
            $q1 = "UPDATE request SET acc = '$request->acc' WHERE id = $request->id";
            $result = $this -> DB->update($q1);
            return true;
        }
        else
        {
            echo "error in database connection";
            $this->DB->closeconnection();
            return false;
        }
    }

}