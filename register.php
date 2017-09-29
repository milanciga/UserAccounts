REGISTER.PHP
<?php
    include "validate.inc";
    include "testdb.inc";
    session_start();
    
    if(!empty($aUser))
    {
        // korisnik je vec registrovan i logovan
        header("Location: home.php");
    }
    else
    {
        // Korisnika treba registrovati
        if ($_SERVER["REQUEST_METHOD"] != "POST") 
        {
            // Korisnik je prvi put na stranici, prikazati formu
            include "register_form.html";
        }
        else
        {
            // Korisnik je popunio obrazac, treba proveriti podatke 
            // i izvrsiti unos u bazu ili prikazati gresku
            $Name = $_POST['frmName'];
            $Email = $_POST['frmEmail'];
            $Password = $_POST['frmPassword'];
            
            $message = "";
            $link = "";
            
            if(IsEmail($Email))
            {
                If(IsName($Name))
                {
                    if(IsPassword($Password))
                    {
                        if(UsernameExists($Email)== "NEMA")
                        {    
                            // Podaci su pravilno uneti pa mozemo registrovati novog korisnika
                            $inserted = InsertUser($Name, $Email, $Password);
                            // echo "<br/>inserted=$inserted";
                            if($inserted)
                            {
                                // podaci su uneseni
                                session_register('aUser');
                                $aUser = $Name;
                                
                                $link = "<a href='home.php'>ovde</a>";
                                $message = "\nDobro dosli $Name";
                                $message .= "\nVratite se na pocetnu stranu $link"; 
                            }
                            else
                            {
                                // podaci nisu uneti
                                $link = "<a href='home.php'>ovde</a>";
                                $message = "Doslo je do nekih problema. Probajte opet $link";    
                            }
                        }
                        else
                        {
                            // Vec postoji korisnik sa takvim imenom
                            $link = "<a href='register.php'>ovde</a>";
                            $message = "Vec postoji korisnik sa takvim korisnickim imenom. Probajte opet $link";
                            
                        }
                    }
                    else
                    {
                        $link = "<a href='register.php'>ovde</a>";
                        $message = "Korisnicka sifra mora biti najmanje 8 znaka duga";
                        $message .= " i mora sadrzati samo alfanumericke znake. Probajte opet $link";
                    }
                }
                else
                {
                    $link = "<a href='register.php'>ovde</a>";
                    $message = "Ime mora sadrzati samo znakove alfabeta. Probajte opet $link";
                }
            }
            else
            {
                $link = "<a href='register.php'>ovde</a>";
                $message = "Email nije pravilno unet. Probajte opet $link";
                
            } // if(IsEmail($Email))
            
            echo $message ; // Stampamo poruku o uspesnoj registraciji ili poruku o gresci
                            // Ako ima greske vracamo na formu za registraciju a ako nema
                            // izjavljujemo dobrodoslicu i link prema pocetnoj strani
            
        }
            
    }



?>