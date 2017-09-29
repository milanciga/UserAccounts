HOME PAGE
<?php

/**
 * @author 
 * @copyright 2017
 */

    session_start();
    
    if(empty($aUser))
    {
        // korisnik nije logovan
        include "login_form.html";
    }
    else
    {
        // korisnik je logovan sa korisnickim imenom $aUser
        header("Location: search.php");
    }

?>