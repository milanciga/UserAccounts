HOME PAGE
<?php
    
/**
 * @author Milan Ilic <milanciga@yahoo.com>
 * @copyright 2017, Milan Ilic
 * @package LogIn
 */

session_start();


if (empty($_SESSION['aUser'])) {
    // korisnik nije logovan
    include "forms/login_form.html";
} else {
    // korisnik je logovan sa korisnickim imenom $aUser
    header("Location: search.php");
    
}

?>