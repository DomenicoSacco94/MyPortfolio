<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Work{ 

        static function already_registered($Work_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT FROM work WHERE Work_name=:name");
        $stmt->bindParam(":name", $Work_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
    
        static function already_is($id,$Work_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT Work_name FROM work WHERE idWork=:id");
        $stmt->bindParam(":idWork", $id);
        $stmt->execute();
        $previous_name=$stmt->fetchColumn();
        if ($Work_name==$previous_name) {return false;}
        else {
        $stmt = $conn->prepare("SELECT * FROM work WHERE Work_name=:name");
        $stmt->bindParam(":name", $Work_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
        }
        
        static function delete_contributions($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM artist_work WHERE Work_idWork=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}        
        }
        
    static function retrieve_id_work($Work_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect();    
        $stmt = $conn->prepare("SELECT idWork FROM work where Work_name=:name");
        $stmt->bindParam(":name", $Work_name);
        $stmt->execute(); 
        $id_work="";
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Work');
        while ($work=$stmt->fetch()) {
            $id_work=$work->getIdWork();
        }
        return $id_work; 
        }   
        
    static function create_work($name,$material,$type,$date,$description,$Room_name,$Work_img_name,$Work_path) {
        try{
        if(!DAL_Work::already_registered($name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\work\\uploads\\";
        $target_path = $target_path . basename($Work_img_name);  
        if (move_uploaded_file($Work_path, $target_path)) {
        $Work_data = base64_encode(file_get_contents($target_path));
        $Work_data = 'data:image/jpg' . ';base64,' . $Work_data;
        }
        else
        {$Work_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $roomID=DAL_Room::retrieve_id_room($Room_name);
        $stmt = $conn->prepare("INSERT INTO work (Work_name,material,type,date,Work_description,Room_idRoom,Work_image) "
                . "VALUES (:name,:material,:type,:date,:description,:Room_idRoom,:Work_image)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":material", $material);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":Room_idRoom", $roomID);
        $stmt->bindParam(":Work_image", $Work_data);
        $stmt->execute();        
        $sql="INSERT INTO work (Work_name,material,type,date,Work_description,Room_idRoom) "
                . "VALUES (".$name.",".$material.",".$type.",".$date.",".$description.",".$roomID.")"; 
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        //echo "Affected rows: " .$outcome;
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
    
        static function retrieve_works() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM work INNER JOIN room ON room.idRoom=work.Room_idRoom");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Work'); 
        $works_array = [];
        $index=0;
        while ($work=$stmt->fetch()) {
            $works_array[$index]=$work;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $works_array;
        } 
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function retrieve_works_for_rooms() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM work INNER JOIN artist_work ON artist_work.Work_idWork=work.idWork INNER JOIN artist on artist.idArtist=artist_work.Artist_idArtist INNER JOIN room ON work.Room_idRoom=room.idRoom GROUP BY Work_name ORDER BY idRoom");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Work'); 
        $works_array = [];
        $index=0;
        while ($work=$stmt->fetch()) {
            $works_array[$index]=$work;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $works_array;
        } 
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function retrieve_works_for_artists() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM work INNER JOIN artist_work ON artist_work.Work_idWork=work.idWork INNER JOIN artist on artist.idArtist=artist_work.Artist_idArtist INNER JOIN room ON work.Room_idRoom=room.idRoom  GROUP BY Work_name ORDER BY Artist_name ");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Work'); 
        $works_array = [];
        $index=0;
        while ($work=$stmt->fetch()) {
            $works_array[$index]=$work;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $works_array;
        } 
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_work($workID) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        DAL_Work::delete_contributions($workID);
        $stmt = $conn->prepare("DELETE FROM work WHERE idWork=:workid");
        $stmt->bindParam(":workid", $workID);
        $sql = "DELETE FROM work WHERE idWork='" . $workID ."'";
        $stmt->execute();
        $outcome=$stmt->rowCount();
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null;
        if ($outcome!==0) {return 0;}
        else {return 3;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function update_work($workID,$name,$material,$type,$date,$description,$Room_name,$Work_img_name,$Work_path) {
        try{
        if(!DAL_Work::already_is($workID, $name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\work\\uploads\\";
        $target_path = $target_path . basename($Work_img_name);  
        if (move_uploaded_file($Work_path, $target_path)) {
        $Work_data = base64_encode(file_get_contents($target_path));
        $Work_data = 'data:image/jpg' . ';base64,' . $Work_data;
        }
        else
        {$Work_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $roomID=DAL_Room::retrieve_id_room($Room_name);
        $stmt = $conn->prepare("UPDATE work SET Work_name=:name,material=:material,type=:type,date=:date,Work_description=:description,Room_idRoom=:Room_idRoom,Work_image=:Work_image WHERE idWork=:idWork");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":material", $material);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":Room_idRoom", $roomID);
        $stmt->bindParam(":idWork", $workID);
        $stmt->bindParam(":Work_image", $Work_data);
        $stmt->execute();        
        $sql="UPDATE work SET Work_name=:name,material=:material,type=:type,date=:date,Work_description=:description,Room_idRoom=:Room_idRoom WHERE idWork=:idWork";      
        //echo "<br> SQL Statement: <br>" . $sql;
         $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
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
}
?>