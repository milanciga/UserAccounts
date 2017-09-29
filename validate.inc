<?php

function IsName($name){
    if (preg_match("/^[a-zA-Z'-]+$/", $name) === 1)
        return true;
    else
        return false;
}

function IsEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function IsPassword($pass){
    if(ctype_alnum($pass)&&(strlen($pass)>7))
        return true;
    else
        return false;
}

?>