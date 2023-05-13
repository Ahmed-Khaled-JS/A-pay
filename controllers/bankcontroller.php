<?php
require_once '../models/account.php';
require_once '../controllers/DBcon.php';

class bankcontroller 
{
    protected $DB;
    public function getbanks(){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query = "SELECT * FROM banks";
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
}
?>