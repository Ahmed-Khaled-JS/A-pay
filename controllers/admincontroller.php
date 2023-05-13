<?php
require_once '../controllers/DBcon.php';
require_once '../models/trans.php';
require_once '../models/user.php';
class AdminController 
{
    protected $DB;
    public function get_users(){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
           
            $q1 = "SELECT * FROM user";
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
    public function get_trans(){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {  
            $q1 = "SELECT * FROM trans";
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
    
    public function search_user($by,$substring){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
           
            $q1 = "SELECT * FROM user WHERE $by LIKE '%$substring%' OR lastName LIKE '%$substring%'";
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
    public function search_tran($by,$substring){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
           
            $q1 = "SELECT * FROM trans WHERE $by LIKE '%$substring%'";
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
    public function Block_user(user $user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            
           
            $q1 = "UPDATE user SET role_id = '$user->role_id' WHERE id = $user->id";
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
?>