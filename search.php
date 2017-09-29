SEARCH.PHP
<?php
    include "validate.inc";
    include "testdb.inc";
    session_start();
    
    if(empty($aUser))
    {
        // korisnik nije logovan
        header("Location: home.php");
    }
    
    if ($_SERVER["REQUEST_METHOD"] != "POST") 
    {
        // Korisnik je prvi put na stranici, prikazati formu za pretrazivanje
        include "search_form.html";
    }
    else
    {
        // Korisnik je uneo parametar za pretragu
        $Criteria = $_POST['frmCriteria'];
        $message = "";
        $link = "";
        
        $match = GetUsers($Criteria);
        
        
        if(is_null($match))
        {
            // Doslo je do greske
            $link = "<a href='search.php'>ovde</a>";
            $message = "Doslo je do greske. Probajte opet $link";
        }
        else
        {
            if($match == "empty")
            {
                // Nema korisnika sa datim kriterijumom
                $link = "<a href='search.php'>ovde</a>";
                $message = "Nema korisnika sa datim kriterijumom. Probajte opet $link";
            }
            else
            {
                // $metch sadzi asocijativan niz u formi $metch['Email']="Name"
                echo "<br />Pronadjeni su sledeci korisnici: <br /><br />";
                echo "Email \t\t Ime";
                foreach($match as $tmpEmail => $tmpName)
                {
                    echo "$tmpEmail \t\t $tmpName";
                }
                
                $link = "<a href='search.php'>ovde</a>";
                $message = "Zelite da probate opet?. Idite $link";
            }
        }
        // $
    }
    



?>