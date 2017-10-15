<?php

class User
{
    private $name = null;
    private $email = null;
    private $password = null;
    
    public function __construct($name, $email, $password)
    {
        if ((isset($name)) && (isset($email)) && (isset($password))) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        } else {
            return false;
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}

?>