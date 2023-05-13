<?php
class dbconnect{
    private $host="localhost";
    private $user="root";
    private $password="";
    private $database="apay";
    function connect(){
      try {
        $connect= mysqli_connect($this->host, $this->user, $this->password, $this->database);
        mysqli_connect_errno();
        
      } catch (\Throwable $th) {
        die('Error: '.mysqli_connect_error());
      }
      return $connect;
}}
?>