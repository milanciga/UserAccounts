<?php
    include "validate.inc";
    include "testdb.inc";
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] != "POST") 
        {
            // Nisu prosledjeni podaci pa korisnika treba vratiti na pocetnustranu
            header("Location: home.php");
        }
        else
        {
            // Prosledjeni su podaci korisnicko ime i sifra
            $Email = $_POST['frmEmail'];
            $Password = $_POST['frmPassword'];
            
            $message = "";
            $link = "";
            
            // Zbog zloupotreba proveravamo $Email i $Password
            
            if((IsEmail($Email)) && IsPassword($Password))
            {
                // Podaci su sigurni i pravilno uneti. Mozemo proveriti u bazi
                if(UserExists($Email,$Password)== "IMA")
                {
                    // Korisnik postoji sa datom sifrom pa ga mozemo logovati
                    $_SESSION['aUser'] = $Name;
                                       
                    $link = "<a href='home.php'>ovde</a>";
                    $message = "\nDobro dosli $Name";
                    $message .= "\nVratite se na pocetnu stranu $link"; 
                }
                else
                {
                    // Podaci pogresno uneti. Ne postoji korisnik sa datim korisnickim imenom i sifrom
                    $link = "<a href='home.php'>ovde</a>";
                    $message = "Pogresno korisnicko ime ili lozinka. Probajte opet $link";
                }
                
            }
            else
            {
                // Podaci su pogresno uneti. Vratiti na pocetnu stranu
                $link = "<a href='home.php'>ovde</a>";
                $message = "Podaci nisu pravilno uneti. Probajte opet $link";
            } // if((IsEmail($Email))...
            
            echo $message ;
            
        }
        



?>