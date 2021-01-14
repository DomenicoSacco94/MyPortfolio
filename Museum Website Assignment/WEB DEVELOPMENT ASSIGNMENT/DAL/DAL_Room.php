<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DAL_Room{ 
    
        static function already_registered($Room_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT FROM room WHERE Room_name=:name");
        $stmt->bindParam(":name", $Room_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
    
        static function already_is($id,$Room_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT Room_name FROM room WHERE idRoom=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $previous_name=$stmt->fetchColumn();
        if ($Room_name==$previous_name) {return false;}
        else {
        $stmt = $conn->prepare("SELECT * FROM room WHERE Room_name=:name");
        $stmt->bindParam(":name", $Room_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
        }
    
        static function delete_works($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM work WHERE Room_idRoom=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}            
        }
        
    static function retrieve_id_room($Room_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect();    
        $stmt = $conn->prepare("SELECT idRoom FROM room where Room_name=:name");
        $stmt->bindParam(":name", $Room_name);
        $stmt->execute();
        $id_room="";
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Room');
        while ($room=$stmt->fetch()) {
            $id_room=$room->getIdRoom();
        }
        return $id_room; 
        }
        
    static function create_room($floor,$number,$name,$description,$Museum_name,$Room_img_name,$Room_path) {
        try{
        if(!DAL_ROOM::already_registered($name)) {
            
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\room\\uploads\\";
        $target_path = $target_path . basename($Room_img_name);
        if (move_uploaded_file($Room_path, $target_path)) {
        $Room_data = base64_encode(file_get_contents($target_path));
        $Room_data = 'data:image/jpg' . ';base64,' . $Room_data;
        }
        else
        {$Room_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $Museumid=DAL_Museum::retrieve_id_museum($Museum_name);
        $stmt = $conn->prepare("INSERT INTO room (floor,number,Room_name,Room_description,Museum_idMuseum,Room_image) "
                . "VALUES (:floor,:number,:name,:description,:idMuseum,:Room_image)");
        $stmt->bindParam(":floor", $floor);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":idMuseum", $Museumid);
        $stmt->bindParam(":Room_image", $Room_data);
        $stmt->execute();        
        $sql="INSERT INTO room (floor,number,Room_name,Room_description,Museum_idMuseum) "
                . "VALUES (".$floor.",".$number.",".$name.",".$description.",".$Museumid.")"; 
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        //echo "<br> Inserted ID " .$conn->lastInsertId();
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
    
        static function retrieve_rooms() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM room INNER JOIN museum ON room.Museum_idMuseum=museum.idMuseum");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Room'); 
        $sql = "SELECT * FROM room";
        $rooms_array = [];
        $index=0;
        while ($room=$stmt->fetch()) {
            $rooms_array[$index]=$room;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $rooms_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }

        static function retrieve_rooms_for_museums() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM room INNER JOIN museum ON room.Museum_idMuseum=museum.idMuseum ORDER BY Room_name");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Room'); 
        $rooms_array = [];
        $index=0;
        while ($room=$stmt->fetch()) {
            $rooms_array[$index]=$room;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $rooms_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_room($roomID) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        DAL_ROOM::delete_works($roomID);
        $stmt = $conn->prepare("DELETE FROM room WHERE idRoom=:roomid");
        $sql = "DELETE FROM room WHERE idRoom='" . $roomID ."'";
        $stmt->bindParam(":roomid", $roomID);
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
    
    static function update_room($roomid,$floor,$number,$name,$description,$Museum_name,$Room_img_name,$Room_path) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        if(!DAL_ROOM::already_is($roomid,$name)) {
            
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\room\\uploads\\";
        $target_path = $target_path . basename($Room_img_name);
        if (move_uploaded_file($Room_path, $target_path)) {
        $Room_data = base64_encode(file_get_contents($target_path));
        $Room_data = 'data:image/jpg' . ';base64,' . $Room_data;
        }
        else
        {$Room_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();        
        $MuseumID=DAL_Museum::retrieve_id_museum($Museum_name);
        $stmt = $conn->prepare("UPDATE room SET floor=:floor,number=:number,Room_name=:name,Room_description=:description,Museum_idMuseum=:Museum_idMuseum,Room_image=:Room_image WHERE idRoom=:idRoom");
        $stmt->bindParam(":floor", $floor);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":Museum_idMuseum", $MuseumID);
        $stmt->bindParam(":idRoom", $roomid);
        $stmt->bindParam(":Room_image", $Room_data);
        $stmt->execute();        
        $sql="UPDATE room SET floor=:floor,number=:number,Room_name=:name,description=:description,Museum_idMuseum=:Museum_idMuseum WHERE idRoom=:id";      
        //echo "<br> SQL Statement: <br>" . $sql;
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