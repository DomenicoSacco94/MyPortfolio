<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Artist_Work{  
    
    static function already_registered($Artist_name,$Work_name) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $ArtistID= DAL_Artist::retrieve_id_artist($Artist_name);
    $WorkID= DAL_Work::retrieve_id_work($Work_name);
    $stmt = $conn->prepare("SELECT * FROM artist_work WHERE Artist_idArtist=:idArtist AND Work_idWork=:idWork ORDER BY work.Work_name");
    $stmt->bindParam(":idArtist", $ArtistID);
    $stmt->bindParam(":idWork", $WorkID);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}        
    }   
    
    static function create_artist_work($Artist_name,$Work_name,$contribuition) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        if(!DAL_Artist_Work::already_registered($Artist_name, $Work_name)) {
        $Artist_idArtist= DAL_Artist::retrieve_id_artist($Artist_name);
        $Work_idWork= DAL_Work::retrieve_id_work($Work_name);   
        $stmt = $conn->prepare("INSERT INTO artist_work (Artist_idArtist,Work_idWork,contribuition) "
                . "VALUES (:Artist_idArtist,:Work_idWork,:contribuition)");
        $stmt->bindParam(":Artist_idArtist", $Artist_idArtist);
        $stmt->bindParam(":Work_idWork", $Work_idWork);
        $stmt->bindParam(":contribuition", $contribuition);
        $stmt->execute();        
        $sql="INSERT INTO artist_work (Artist_idArtist,Work_idWork,contribuition) "
                . "VALUES (".$Artist_idArtist.",".$Work_idWork.",".$contribuition.")"; 
        //echo "<br> SQL Statement: <br>" . $sql;
        $stmt->rowCount();
        $outcome=$stmt->rowCount();
        //echo "<br> Affected rows " .$outcome;
        $conn = null; 
        if($outcome !== 0) {return 0;}
        else {return 1;}
        } {return 4;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function retrieve_artist_works() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT Artist_name,Work_name,contribuition FROM artist_work JOIN artist ON artist.idArtist=artist_work.Artist_idArtist JOIN work ON work.idWork=artist_work.Work_idWork");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Artist_Work');  
        $artist_work_array = [];
        $index=0;
        while ($artist_work=$stmt->fetch()) {
            $artist_work_array[$index]=$artist_work;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $artist_work_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_artist_work($Artist_name,$Work_name) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $artistID= DAL_Artist::retrieve_id_artist($Artist_name);
        $workID= DAL_Work::retrieve_id_work($Work_name);  
        $stmt = $conn->prepare("DELETE FROM artist_work WHERE Artist_idArtist=:artistid AND Work_idWork=:workid");
        $sql = "DELETE FROM artist_work WHERE Artist_idArtist='" . $artistID ."' AND Work_idWork='" . $workID ."'";
        $stmt->bindParam(":artistid", $artistID);
        $stmt->bindParam(":workid", $workID);
        $stmt->execute();  
        $outcome=$stmt->rowCount();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        if ($outcome !== 0 ) {return 0;}
        else {return 3;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function update_artist_work($Artist_name,$Work_name,$contribuition) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $Artist_idArtist= DAL_Artist::retrieve_id_artist($Artist_name);
        $Work_idWork= DAL_Work::retrieve_id_work($Work_name);  
        $stmt = $conn->prepare("UPDATE artist_work SET contribuition=:contribuition WHERE Artist_idArtist=:idArtist AND Work_idWork=:idWork");
        $stmt->bindParam(":contribuition", $contribuition);
        $stmt->bindParam(":idArtist", $Artist_idArtist);
        $stmt->bindParam(":idWork", $Work_idWork);
        $stmt->execute();        
        $sql="UPDATE artist_work SET contribuition=:contribuition WHERE Artist_idArtist=:idArtist AND Work_idWork=:idWork";      
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        //echo "<br> Inserted ID " .$outcome;
        $conn = null; 
        if($outcome !== 0) {return 0;}
        else {return 2;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
}
?>