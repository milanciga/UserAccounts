<?php


class Validate
{
    const MIN_CHAR_IN_PASSWORD = 7;
    
    public static function isName($name)
    {
        if (preg_match("/^[a-zA-Z'-]+$/", $name) === 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function isPassword($pass)
    {
        if (ctype_alnum($pass)&&(strlen($pass) > Validate::MIN_CHAR_IN_PASSWORD)) {
            return true;
        } else {
            return false;
        }
    }
}
?>