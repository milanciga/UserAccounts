SEARCH.PHP
<?php
require "users/validate.inc";
require "users/userdb.inc";
require "users/usertable.inc";

session_start();
$aUser = $_SESSION['aUser'];
    
if (empty($aUser)) {
    header("Location: home.php");
}
    echo "<br />$aUser";
    echo "<a href='logout.php' style='margin: 0px 15px;'>izloguj se</a><br /><br />";
    
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    include "forms/search_form.html";
} else {
    $criteria = $_POST['frmCriteria'];
    $message = "";
    $link = "";
        
    $db = DbConnection::getInstance("localhost", "testdb", "root", "");
    $userdb = UserDb::getInstance($db);
    
    $match = $userdb->getUsers($criteria);
                
    if (!($match)) {
        $link = "<a href='search.php'>ovde</a>";
        $message = "Doslo je do greske. Probajte opet $link";
    } else {
        if ($match->isEmpty()) {
            $link = "<a href='search.php'>ovde</a>";
            $message = "Nema korisnika sa datim kriterijumom. Probajte opet $link";
        } else {
            // $metch sadzi asocijativan niz u formi $metch['Email']="Name"
            echo "<br />Pronadjeni su sledeci korisnici: <br /><br />";
            $table = new UserTable($match);
            $table->show();         
                
            $link = "<a href='search.php'>ovde</a>";
            $message = "Zelite da probate opet?. Idite $link";
        }
    }
    echo "<br /><br />".$message;
}
?>
