<?php
require_once '../models/user.php';
require_once '../controllers/DBcon.php';

class Auth 
{
    protected $DB;
    public function login(user $user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $query = "SELECT * FROM user WHERE phone = '$user->phone' ";

            $result = $this -> DB->select($query);
        
            if($result === false){
                echo "ERROR in query";
                $this->DB->closeconnection();
                return false;
            }
            else
            {
                if(count($result) == 0){
                    $this->DB->closeconnection();
                    return false;
                }
                else
                {
                    // print_r($result);
                    
                    if(  $result[0]["password"] == $user->password){
                        session_start();
                        $_SESSION["user_id"] = $result[0]["id"];
                        $_SESSION["user_active"] = $result[0]["status"];
                        $_SESSION["user_role"] = $result[0]["role_id"];
                        return true;
                    }
                    else
                    {
                        $this->DB->closeconnection();
                        return false;
                    }

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
    public function register(user $user){
        $this ->DB = new DBcon();
        if($this->DB->openconnection())
        {
            $q1 = "SELECT * FROM user WHERE phone = '$user->phone' ";
            $result = $this -> DB->select($q1);
            if(count($result) == 0){
                $query = "INSERT INTO user VALUES ('','$user->firstName', '$user->lastName', '$user->phone', '$user->password', '1', 'active', '$user->email');";
                $result = $this -> DB->insert($query);
                if($result !== false){
                    session_start();
                    $_SESSION["user_id"] = $result;
                    $_SESSION["user_role"] = "1";
                    $_SESSION["user_active"] = "inactive";
                    $_SESSION["pass-active"] = rand(1000,9999);
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
            return false;
        }
    }
}
?>