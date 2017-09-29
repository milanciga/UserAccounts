<?php

function ConnectToTestDB()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "testdb";
    $con = mysqli_connect($host,$user,$password);
    if($con) 
    {
        $db = mysqli_select_db($con,"TestDB");
        if(!$db)
            echo "Veza sa bazom podataka nije uspostavljena";
        else 
            return $con;   // Veza je uspesno uspostavljena
    }
    else
       echo "Veza sa serverom nije uspostavljena";
}

function UserExists($tmpEmail,$tmpPassword){
    if($con = ConnectToTestDB())
    {
        // Unosimo podatke
        $sql = "SELECT * FROM users";
        $sql .=" WHERE (email='$tmpEmail')";
        $sql .=" AND (password='$tmpPassword')";
        echo "<br/>sql= $sql";
        
        $result = mysqli_query($con,$sql);
        if($result)
        {   
           $strReturn = "";
           if(mysqli_num_rows($result) == 0)
            {
                // Nepostoji korisnik sa takvim korisnickim emailom pa moze biti dodat
                $strReturn = "NEMA";
            }
            else
                $strReturn = "IMA";
        }
        else
            $strReturn = false;
            
        mysqli_close($con);
        return $strReturn;    
    }   //  if($con = ConnectToTestDB())
    else
    {
        // Veza nije uspostavljena
        echo "Upit nije izvrsen!";
        return false;
    }
}


function UsernameExists($tmpEmail){
    if($con = ConnectToTestDB())
    {
        // Unosimo podatke
        $sql = "SELECT * FROM users";
        $sql .="WHERE email='$tmpEmail'";
               
        $result = mysqli_query($con,$sql);
        if($result)
        {   
           $strReturn = "";
           if(mysqli_num_rows($result) == 0)
            {
                // Nepostoji korisnik sa takvim korisnickim emailom pa moze biti dodat
                $strReturn = "NEMA";
            }
            else
                $strReturn = "IMA";
        }
        else
            $strReturn = false;
            
        mysqli_close($con);
        return $strReturn;    
    }   //  if($con = ConnectToTestDB())
    else
    {
        // Veza nije uspostavljena
        echo "Upit nije izvrsen!";
        return false;
    }        
}

function InsertUser($Name,$Email,$Password){
    
    if($con = ConnectToTestDB())
    {
        // Unosimo podatke
        $sql = "INSERT INTO users (email,name,password)";
        $sql .=" VALUES ('$Email','$Name','$Password')";
        echo "<br/>sql= $sql";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        
        if($result)
            return true;
        else
            return false;
            
    }
    else
    {
        // Veza nije uspostavljena
        echo "Upit nije izvrsen!";
        return false;
    }    
}

function GetUsers($criteria){
    
    if($con = ConnectToTestDB())
    {
        $sql = "SELECT email, name FROM Users ";
        $sql .= "WHERE (email LIKE '%".$criteria."%')";
        $sql .= " OR (name LIKE '%".$criteria."%)";
        
        $result = mysqli_query($con,$sql);
        
        if($result)
        {
            // Vraceni su korisnici koji odgovaraju kriterijumu
            $tmpUsers = null;
            if(mysqli_num_rows($result) == 0)
            {
                // Upit izvrsen ali u bazi nema korisnika sa zadatim kriterijumom
                return "empty";
            }
            
            while ($row = mysql_fetch_assoc($result)) {
                $tmpUsers[$row["email"]] = $row["name"];
            }
            mysqli_close($con);
            return $tmpUsers;
            
        }
        else
            return false;
    }
    else
    {
        // Veza nije uspostavljena
        return false;
    }
}
?>