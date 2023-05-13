<?php
class DBcon {
  // Properties
  public $dbhost="localhost";
  public $dbuser="root";
  public $dbpass="";
  public $dbname="apay";
  
  
  // Methods
  public function openconnection() {
    $this->connection = new mysqli($this->dbhost, $this->dbuser,$this->dbpass,$this->dbname);
    if($this->connection->connect_error){
        echo "Error in connection". $this->connection->connect_error;
        return false;
    }else{
        return true;
    }
  }
  public function closeconnection() {
    if($this->connection)
    {
        $this->connection->close();
    }else{
        echo "connection closed";
    }
  }
  public function select($qry) {
    $result = $this->connection->query($qry);
    if(!$result){
      echo "Error in query" .mysqli_error($this->connection);
      return false;
    }else{
      return $result->fetch_all(MYSQLI_ASSOC);
    }

  }
  public function insert($qry) {
    $result = $this->connection->query($qry);
    if(!$result){
      echo "Error in query" .mysqli_error($this->connection);
      return false;
    }else{
      // session_start();
      return $this->connection->insert_id;
      // return true;
    }

  }
  public function update($qry) {
    $result = $this->connection->query($qry);
    if(!$result){
      echo "Error in query" .mysqli_error($this->connection);
      return false;
    }else{
    
      return true;
    }

  }
}
?>