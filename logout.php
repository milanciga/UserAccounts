<?php

    // Potrebno je da ponistavanjem promenjive $aUser izlogujemo korisnika
    session_start();
    //session_destroy();
    $_SESSION['aUser'] = "";
    header("Location: home.php");


?>