<?php
include_once "userslist.inc";

class UserTable
{
    private $html = "";
    
    public function __construct($usersList = null)
    {
        if (!($usersList instanceof UsersList)) {
            return false;
        }
        $list = $usersList->getAssocArray();
        $this->html = "<table border='1'><tr><th>Name</th><th>Email</th></tr>";
        
        foreach ($list as $email => $data) {
            $this->html .= "<tr><td>".$email."</td><td>".$data['name']."</td></tr>";
        }
        $this->html .= "</table>";
    }
    
    public function show()
    {
        echo $this->html;
    }
    
}


?>