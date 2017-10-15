<?php


class UsersList
{
    private $list = array();
    
    public function add($name, $email, $password)
    {
        $this->list[$email] = array("name" => $name, "password" => $password);
    }
    
    public function getAssocArray() 
    {
        return $this->list;
    }
    
    public function isEmpty()
    {
        if (is_null($this->list)) {
            return true;
        } else {
            return false;
        }
    }
}

?>