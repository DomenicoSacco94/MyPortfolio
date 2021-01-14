<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DAL_Event_Artist{ 

    static function already_registered($Artist_name,$Event_name) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $ArtistID= DAL_Artist::retrieve_id_artist($Artist_name);
    $EventID= DAL_Event::retrieve_id_event($Event_name);
    $stmt = $conn->prepare("SELECT * FROM event_artist WHERE Artist_idArtist=:idArtist AND Event_idEvent=:idEvent");
    $stmt->bindParam(":idArtist", $ArtistID);
    $stmt->bindParam(":idEvent", $EventID);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}        
    }  
    
    static function create_event_artist($Artist_name,$Event_name,$start_date,$end_date,$details) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        if(!DAL_Event_Artist::already_registered($Artist_name,$Event_name)) {
        $Artist_idArtist=DAL_Artist::retrieve_id_artist($Artist_name);
        $Event_idEvent=DAL_Event::retrieve_id_event($Event_name);
        $stmt = $conn->prepare("INSERT INTO event_artist (Artist_idArtist,Event_idEvent,participation_start_date,participation_end_date,details) "
                . "VALUES (:Artist_idArtist,:Event_idEvent,:participation_start_date,:participation_end_date,:details)");
        $stmt->bindParam(":Artist_idArtist", $Artist_idArtist);
        $stmt->bindParam(":Event_idEvent", $Event_idEvent);
        $stmt->bindParam(":participation_start_date", $start_date);
        $stmt->bindParam(":participation_end_date", $end_date);
        $stmt->bindParam(":details", $details);
        $stmt->execute();        
        $sql="INSERT INTO event_artist (Artist_idArtist,Event_idEvent,start_date,end_date,details) "
                . "VALUES (".$Artist_idArtist.",".$Event_idEvent.",".$start_date.",".$end_date.",".$details.")"; 
        //echo "<br> SQL StaINSERT INTO event_artist (Artist_idArtist,Event_idEvent,start_date,end_date,details) VALUES (9,1,2011-11-11 13:00,2011-11-11 13:00,ddd)tement: <br>" . $sql;
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
    
        static function retrieve_event_artists() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM event JOIN event_artist ON event.idEvent=event_artist.Event_idEvent JOIN artist ON event_artist.Artist_idArtist=artist.idArtist ORDER BY event.Event_name");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event_Artist'); 
        $event_artist_array = [];
        $index=0;
        while ($event_artist=$stmt->fetch()) {
            $event_artist_array[$index]=$event_artist;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $event_artist_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function retrieve_events_for_artists() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM event JOIN event_artist ON event.idEvent=event_artist.Event_idEvent JOIN artist ON event_artist.Artist_idArtist=artist.idArtist ORDER BY Event_name");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event_Artist'); 
        $sql = "SELECT * FROM event_artist";
        $visits="";
        while ($event_artist=$stmt->fetch()) {
            $visits = $visits . $event_artist->getEvent_name() . "\t";
            $visits = $visits . $event_artist->getArtist_name() . "\t";
            $visits = $visits . $event_artist->getStart_date() . "\t";
            $visits = $visits . $event_artist->getEnd_date() . "\t";
            $visits = $visits . $event_artist->getDetails() . "<br>";
            $visits = $visits . '<img class="event_image" src="'. $event_artist->getEvent_image() .'"> <br>';
        }        
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $visits;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_event_artist($Artist_name,$Event_name) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $artistID=DAL_Artist::retrieve_id_Artist($Artist_name);
        $eventID=DAL_Event::retrieve_id_Event($Event_name);
        $stmt = $conn->prepare("DELETE FROM event_artist WHERE Artist_idArtist=:artistid AND Event_idEvent=:eventid");
        $sql = "DELETE FROM event_artist WHERE Artist_idArtist='" . $artistID ."' AND Event_idEvent='" . $eventID ."'";
        $stmt->bindParam(":artistid", $artistID);
        $stmt->bindParam(":eventid", $eventID);
        $stmt->execute();    
        $outcome=$stmt->rowCount();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        if ($outcome !== 0) {return 0;}
        else {return 3;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function update_event_artist($Artist_name,$Event_name,$start_date,$end_date,$details) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        if(!($Artist_name=="" || $Event_name=="" || $start_date=="" || $end_date=="" || $details=="")) {
        $Artist_idArtist=DAL_Artist::retrieve_id_artist($Artist_name);
        $Event_idEvent=DAL_Event::retrieve_id_event($Event_name);
        $stmt = $conn->prepare("UPDATE event_artist SET participation_start_date=:start_date,participation_end_date=:end_date,details=:details WHERE Artist_idArtist=:idArtist AND Event_idEvent=:idEvent");
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);
        $stmt->bindParam(":details", $details);
        $stmt->bindParam(":idArtist", $Artist_idArtist);
        $stmt->bindParam(":idEvent", $Event_idEvent);
        $stmt->execute();        
        $sql="UPDATE event_artist SET start_date=:start_date,end_date=:end_date,details=:details WHERE Artist_idArtist=:idArtist AND Event_idEvent=:idEvent";      
        //echo "nm" . $Artist_name . "art" . $Artist_idArtist . "ev" . $Event_idEvent;
        $outcome=$stmt->rowCount();
        //echo "<br> Inserted ID " .$outcome;
        $conn = null;
        if($outcome !== 0) {return 0;}
        else {return 2;}
        } else {return 4;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
}
?>