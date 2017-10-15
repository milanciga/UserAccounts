<?php

include_once "user.inc";
include_once "database.inc";
include_once "userslist.inc";

class UserDb
{
    private $conn = null;
    private static $isOpen = false; 
    
    private function __construct($db)
    {
        if (!($db instanceof DbConnection)) {
            return false;
        } else {
            $this->conn = $db;
        }        
    }
    
    public static function getInstance($db)
    {
        if (false == self::$isOpen){
            self::$isOpen == true;
            return new UserDb($db);
        } else {
            return $this;
        }    
    }
    
    public function insert($user)
    {
        if (!($user instanceof User)) {
            return false;
        }
        
        $sql = "INSERT INTO users (name, email, password) ";
        $sql.= "VALUES ('".$user->getName()."', '".$user->getEmail()."', '".$user->getPassword()."')";
        
        if ($this->conn->dbHandler()->query($sql)) {
            return $this;    
        } else {
            return false;
        }
    }
    
    public function exists($email, $password = null)
    {
        
        if (is_null($password)) {
            $sql = "SELECT email FROM users WHERE email = ?";
            $stmt = $this->conn->dbHandler()->prepare($sql);
            $stmt->bind_param("s", $email);
            
        } else {
            $sql = "SELECT email FROM users WHERE (email = ?) AND (password = ?)";
            $h = $this->conn->dbHandler();
            $stmt = $h->prepare($sql);
            $stmt->bind_param("ss", $email, $password);   
        }
        
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 0) {
            return false;
        } else {
            return true;
        } 
    }
    
    public function find($email)
    {
        if (!(is_string($email))) {
            return false;
        }
        
        $sql = "SELECT name, email, password FROM users WHERE email = ?";
        $h = $this->conn->dbHandler();
        $stmt = $h->prepare($sql);
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            return false;
        }
        
        $stmt->store_result();
        
        if ($stmt->num_rows == 0) {
            return false;
        } else {
            $stmt->bind_result($name, $email, $password);
            $stmt->fetch();
            
            return (new User($name, $email, $password));
        } 
    }
    
    public function getUsers($criteria = "") 
    {
        $sql = "SELECT name, email, password FROM users";
        if (!empty($criteria)) {
            $sql.= " WHERE (email LIKE '%".$criteria."%') ";
            $sql.= "OR (name LIKE '%".$criteria."%')";
        }
        
        $result = $this->conn->dbHandler()->query($sql);
        if (!$result) {
            return false;
        }
        
        $tmpUsers = new UsersList();
        while ($row = $result->fetch_assoc()) {
            $tmpUsers->add($row['name'], $row['email'], $row['password']);        
        }
        
        return $tmpUsers;    
    }
    
    public function vardump()
    {
        var_dump($this->conn);
    }
}



?>