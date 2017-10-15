LOGIN.PHP
<?php
require "users/validate.inc";
require "users/userdb.inc";

session_start();
    
if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: home.php");
} else {
    $email = $_POST['frmEmail'];
    $password = $_POST['frmPassword'];
    $message = "";
    $link = "";
            
    // Zbog zloupotreba proveravamo $Email i $Password
    if ((Validate::isEmail($email)) && Validate::isPassword($password)) {
        $db = DbConnection::getInstance("localhost", "testdb", "root", "");
        $userdb = UserDb::getInstance($db);
             
        if ($userdb->exists($email, $password)) {
            $user = $userdb->find($email);
            $name = $user->getName();
            $_SESSION['aUser'] = $name;
                                                   
            $link = "<a href='home.php'>ovde</a>";
            $message = "<br /><br />Dobro dosli $name";
            $message .= "<br />Vratite se na pocetnu stranu $link"; 
        } else {
            $link = "<a href='home.php'>ovde</a>";
            $message = "<br /><br />Pogresno korisnicko ime ili lozinka.";
            $message .= "Probajte opet $link";
        }
                
    } else {
        // Podaci su pogresno uneti. Vratiti na pocetnu stranu
        $link = "<a href='home.php'>ovde</a>";
        $message = "<br /><br />Podaci nisu pravilno uneti. Probajte opet $link";
    } // if((IsEmail($Email))...
            
    echo $message ;
            
}
        



?>
