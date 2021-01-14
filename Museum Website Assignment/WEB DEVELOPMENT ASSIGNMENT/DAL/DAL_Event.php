<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DAL_Event{ 

    static function already_registered($Event_name) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("SELECT * FROM event WHERE Event_name=:name");
    $stmt->bindParam(":name", $Event_name);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}
    }
    
    static function already_is($id,$Event_name) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("SELECT Event_name FROM event WHERE idEvent=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $previous_name=$stmt->fetchColumn();
    if ($Event_name==$previous_name) {return false;}
    else {
    $stmt = $conn->prepare("SELECT * FROM event WHERE Event_name=:name");
    $stmt->bindParam(":name", $Event_name);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}
    }
    }
    
    static function delete_participations($id) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("DELETE FROM event_artist WHERE Event_idEvent=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}         
    }
    
    static function delete_tickets($id) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("DELETE FROM ticket WHERE Event_idEvent=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}          
    }
    
    static function retrieve_id_event($Event_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect();    
        $stmt = $conn->prepare("SELECT idEvent FROM event where Event_name=:name");
        $stmt->bindParam(":name", $Event_name);
        $stmt->execute(); 
        $id_event="";
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event');
        while ($event=$stmt->fetch()) {
            $id_event=$event->get_idEvent();
        }
        return $id_event; 
        }
        
    static function create_event($start_date,$end_date,$name,$max_tickets,$full_price,$student_price,$reduced_price,$info,$Museum_name,$Event_img_name,$Event_path) {
        try{
        if(!DAL_Event::already_registered($name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\event\\uploads\\";
        $target_path = $target_path . basename($Event_img_name);
        if (move_uploaded_file($Event_path, $target_path)) {
        $Event_data = base64_encode(file_get_contents($target_path));
        $Event_data = 'data:image/jpg' . ';base64,' . $Event_data;
        }
        else
        {$Event_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $Museumid=DAL_Museum::retrieve_id_museum($Museum_name);
        $stmt = $conn->prepare("INSERT INTO event (start_date,end_date,Event_name,max_tickets,Event_info,Museum_idMuseum,full_price,reduced_price,student_price,Event_image) "
                . "VALUES (:start_date,:end_date,:name,:max_tickets,:info,:Museum_idMuseum,:full_price,:reduced_price,:student_price,:Event_image)");
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":max_tickets", $max_tickets);
        $stmt->bindParam(":full_price", $full_price);
        $stmt->bindParam(":reduced_price", $reduced_price);
        $stmt->bindParam(":student_price", $student_price);
        $stmt->bindParam(":info", $info);
        $stmt->bindParam(":Museum_idMuseum", $Museumid);
        $stmt->bindParam(":Event_image", $Event_data);
        $stmt->execute();        
        $sql="INSERT INTO event (start_date,end_date,Event_name,max_tickets,Event_info,Museum_idMuseum,full_price,reduced_price,student_price) "
                . "VALUES (".$start_date.",".$end_date.",".$name.",".$max_tickets.",".$info.",".$Museumid.",".$full_price.",".$reduced_price.",".$student_price.")"; 
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        //echo "<br> Affected rows " .$outcome;
        $conn = null; 
        if($outcome !== 0) {return 0;}
        else {return 1;}
        } else {return 4;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function retrieve_events() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM event INNER JOIN museum ON event.Museum_idMuseum=museum.idMuseum");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event'); 
        $events_array = [];
        $index=0;
        while ($event=$stmt->fetch()) {
            $events_array[$index]=$event;
            $index++;
        }
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $events_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }

        static function retrieve_events_bar() {
        try{
        $record_count=0;
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM event INNER JOIN museum ON event.Museum_idMuseum=museum.idMuseum ORDER BY start_date DESC");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event'); 
        $events_array = [];
        $index=0;
        while ($record_count<3 && $event=$stmt->fetch()) {
            $events_array[$index]=$event;
            $index++;
            $record_count++;
        }        
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $events_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function retrieve_event_price($Event_name,$type) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM event WHERE Event_name=:name");
        $stmt->bindParam(":name", $Event_name);
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Event'); 
        $sql = "SELECT * FROM event WHERE Event_name=:name";
        $visits="";
        while ($event=$stmt->fetch()) {
            if ($type=="normal") {
            $visits = $event->get_full_price();
            }
            else if ($type=="student") {
            $visits = $event->get_student_price();
            }
            else if ($type=="reduced") {
            $visits = $event->get_reduced_price();
            }
        }        
        $stmt->closeCursor();
        $conn = null; 
        return $visits;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_event($eventID) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        DAL_Event::delete_participations($eventID);
        DAL_Event::delete_tickets($eventID);
        $stmt = $conn->prepare("DELETE FROM event WHERE idEvent=:eventid");
        $sql = "DELETE FROM event WHERE idEvent='" . $eventID ."'";
        $stmt->bindParam(":eventid", $eventID);
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
    
    static function update_event($id,$start_date,$end_date,$name,$max_tickets,$full_price,$student_price,$reduced_price,$info,$Museum_name,$Event_img_name,$Event_path) {
        try{
        if(!DAL_Event::already_is($id,$name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\event\\uploads\\";
        $target_path = $target_path . basename($Event_img_name);
        if (move_uploaded_file($Event_path, $target_path)) {
        $Event_data = base64_encode(file_get_contents($target_path));
        $Event_data = 'data:image/jpg' . ';base64,' . $Event_data;
        }
        else
        {$Event_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $Museumid=DAL_Museum::retrieve_id_museum($Museum_name);
        $stmt = $conn->prepare("UPDATE event SET start_date=:start_date,end_date=:end_date,Event_name=:name,max_tickets=:max_tickets,full_price=:full_price,reduced_price=:reduced_price,student_price=:student_price,Event_info=:info,Museum_idMuseum=:Museum_idMuseum,Event_image=:Event_image WHERE idEvent=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":end_date", $end_date);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":max_tickets", $max_tickets);
        $stmt->bindParam(":full_price", $full_price);
        $stmt->bindParam(":reduced_price", $reduced_price);
        $stmt->bindParam(":student_price", $student_price);
        $stmt->bindParam(":info", $info);
        $stmt->bindParam(":Museum_idMuseum", $Museumid);
        $stmt->bindParam(":Event_image", $Event_data);
        $stmt->execute();        
        $sql="UPDATE event SET start_date=".$start_date.",end_date=".$end_date.",Event_name=".$name.",max_tickets=".$max_tickets.",full_price=".$full_price.",reduced_price=".$reduced_price.",student_price=".$student_price.",Event_info=".$info.",Museum_idMuseum=".$Museumid." WHERE idEvent=".$id."";      
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        //echo "<br> Affected Rows " .$outcome;
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