REGISTER.PHP
<?php
require "users/validate.inc";
require "users/userdb.inc";
session_start();
    
if (!empty($aUser)) {
    header("Location: home.php");
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    include "forms/register_form.html";
} else {
    
    $Name = $_POST['frmName'];
    $Email = $_POST['frmEmail'];
    $Password = $_POST['frmPassword'];
    $cPassword = $_POST['frmPassword_check'];
        
    $message = "";
    $link = "";
        
    if (!Validate::isEmail($Email)) {
        $link = "<a href='register.php'>ovde</a>";
        $message = "<br /><br />Email nije pravilno unet. Probajte opet $link";
    } else if (!Validate::isName($Name)) {
        $link = "<a href='register.php'>ovde</a>";
        $message = "<br /><br />Ime mora sadrzati samo znakove alfabeta. Probajte opet $link"; 
    } else if (!Validate::isPassword($Password)) {
        $link = "<a href='register.php'>ovde</a>";
        $message = "<br /><br />Korisnicka sifra mora biti najmanje 8 znaka duga";
        $message .= " i mora sadrzati samo alfanumericke znake. Probajte opet $link";
    } else if ($Password != $cPassword) {
        $link = "<a href='register.php'>ovde</a>";
        $message = "<br /><br />Sifra i ponovljena sifra se ne poklapaju. Probajte opet $link";
    } else {
        $db = DbConnection::getInstance("localhost", "testdb", "root", "");
        $userdb = UserDb::getInstance($db);      
    
        if ($userdb->exists($Email) == false) {    
            $inserted = $userdb->insert(new User($Name, $Email, $Password));
                
            if ($inserted) {
                // podaci su uneseni
                $_SESSION['aUser'] = $Name;
                    
                $link = "<a href='home.php'>ovde</a>";
                $message = "<br /><br />Dobro dosli $Name";
                $message .= "<br />Vratite se na pocetnu stranu $link"; 
            } else {
                // podaci nisu uneti
                $link = "<a href='home.php'>ovde</a>";
                $message = "<br /><br />Doslo je do nekih problema. Probajte opet $link";    
            }
        } else {
            // Vec postoji korisnik sa takvim imenom
            $link = "<a href='register.php'>ovde</a>";
            $message = "<br /><br />Vec postoji korisnik sa takvim korisnickim imenom. Probajte opet $link";
        }
    }
    echo $message ; 
}   
?>
