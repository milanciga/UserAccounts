SEARCH.PHP
<?php
    include "validate.inc";
    include "testdb.inc";
    
    session_start();
    $aUser = $_SESSION['aUser'];
    
    if(empty($aUser))
    {
        // korisnik nije logovan
        header("Location: home.php");
    }
    
    echo "<a href='logout.php'>Izloguj se</a>";
    
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
                
                echo "<table><tr><th>Email</th><th>Ime</th>";
                foreach($match as $tmpEmail => $tmpName)
                {
                    echo "<tr>";
                        echo "<td>$tmpEmail</td>";
                        echo "<td>$tmpName</td>";
                    echo "</tr>";    
                }
                echo "</table>";
                
                $link = "<a href='search.php'>ovde</a>";
                $message = "Zelite da probate opet?. Idite $link";
            }
        }
        
        echo "<br /><br />".$message;
        
    }
    



?>