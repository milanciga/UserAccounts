<?php


class DbConnection
{
    private $host = null;
    private $database = null;
    private $username = null;
    private $password = null;
    
    private static $isSet = false;
    private $dbh = null;
    
    private function __construct($host, $database, $username, $password)
    {
        $this->dbh = new mysqli($host, $username, $password, $database);
        
        if($this->dbh->connect_errno > 0){
            die('Unable to connect to database [' . $this->dbh->connect_error . ']');
        }
    }
    
    public static function getInstance($host, $database, $username, $password)
    {
        if (false == self::$isSet){
            self::$isSet = true;
            return new DbConnection($host, $database, $username, $password);
        } else {
            return $this;
        }    
    }
    
    public function dbHandler()
    {
        return $this->dbh;
    }
}


?>