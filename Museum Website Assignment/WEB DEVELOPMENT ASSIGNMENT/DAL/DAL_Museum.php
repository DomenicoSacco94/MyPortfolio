<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Museum{
    
        static function already_registered($Museum_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT FROM museum WHERE Museum_name=:name");
        $stmt->bindParam(":name", $Museum_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
    
        static function already_is($id,$Museum_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT Museum_name FROM museum WHERE idMuseum=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $previous_name=$stmt->fetchColumn();
        if ($Museum_name==$previous_name) {return false;}
        else {
        $stmt = $conn->prepare("SELECT * FROM museum WHERE Museum_name=:name");
        $stmt->bindParam(":name", $Museum_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
        }
        
        static function delete_events_artists($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0; DELETE FROM event_artist WHERE Event_idEvent IN (SELECT idEvent FROM event WHERE Museum_idMuseum=:id)");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}            
        }
        
        static function delete_events($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM event WHERE Museum_idMuseum=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}            
        }
        
        static function delete_rooms($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM room WHERE Museum_idMuseum=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}             
        }
        
        static function delete_works($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM work WHERE Room_idRoom IN (SELECT idRoom FROM room WHERE Museum_idMuseum=:id)");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}     
        }
        
        static function delete_works_rooms($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM work WHERE Room_idRoom IN (SELECT idRoom FROM room WHERE Museum_idMuseum=:id)");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}     
        }
        
        static function delete_artist_work($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM artist_work WHERE Work_idWork IN (SELECT idWork FROM work WHERE Room_idRoom IN (SELECT idRoom FROM room WHERE Museum_idMuseum=:id))");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}     
        }
        
        static function delete_tickets($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM ticket WHERE Event_idEvent IN (SELECT idEvent FROM event WHERE Museum_idMuseum=:id)");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}            
        }
        
        static function retrieve_id_museum($Museum_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect();    
        $stmt = $conn->prepare("SELECT idMuseum FROM museum where Museum_name=:name");
        $stmt->bindParam(":name", $Museum_name);
        $stmt->execute();
        $id_museum="";
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Museum');
        while ($museum=$stmt->fetch()) {
            $id_museum=$museum->getIdMuseum();
        }
        return $id_museum; 
        }
        
    static function create_museum($name,$address,$Telephone_number,$mail,$info,$Museum_img_name,$Museum_path) {
        try{
        if(!DAL_Museum::already_registered($name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\museum\\uploads\\";
        $target_path = $target_path . basename($Museum_img_name);
        if (move_uploaded_file($Museum_path, $target_path)) {
        $Museum_data = base64_encode(file_get_contents($target_path));
        $Museum_data = 'data:image/jpg' . ';base64,' . $Museum_data;
        }
        else
        {$Museum_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("INSERT INTO museum (Museum_name,address,Telephone_number,Mail,Museum_info,Museum_image) VALUES (:name,:address,:Telephone_number,:mail,:info,:Museum_image)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":Telephone_number", $Telephone_number);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":info", $info);
        $stmt->bindParam(":Museum_image", $Museum_data);
        $stmt->execute();
        $sql="INSERT INTO museum (Museum_name,address,Telephone_number,Mail,Museum_info) VALUES ('".$name."','".$address."','".$Telephone_number."','" .$mail."','".$info."')";     
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
    
    static function update_museum($id,$name,$address,$Telephone_number,$mail,$info,$Museum_img_name,$Museum_path) {
        try{
        if(!DAL_Museum::already_is($id, $name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\museum\\uploads\\";
        $target_path = $target_path . basename($Museum_img_name);
        if (move_uploaded_file($Museum_path, $target_path)) {
        $Museum_data = base64_encode(file_get_contents($target_path));
        $Museum_data = 'data:image/jpg' . ';base64,' . $Museum_data;
        }
        else
        {$Museum_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("UPDATE museum SET Museum_name=:name, Address=:address, Telephone_number=:Telephone_number, Mail=:mail, Museum_info=:info, Museum_image=:Museum_image WHERE idMuseum=:id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":Telephone_number", $Telephone_number);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":info", $info);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":Museum_image", $Museum_data);
        $stmt->execute();   
        $outcome=$stmt->rowCount();
        $sql="UPDATE museum SET Museum_name='".$name."', Address='".$address."', Telephone_number='".$Telephone_number."', Mail='" .$mail."',Museum_info='".$info."' WHERE idMuseum='" .$id. "'" ;      
        //echo "<br> SQL Statement: <br>" . $sql;
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
    
        static function retrieve_museums() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * from museum");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Museum'); 
        $museums_array = [];
        $index=0;
        while ($museum=$stmt->fetch()) {
            $museums_array[$index]=$museum;
            $index++;
        }  
        $stmt->closeCursor();        
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        return $museums_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function delete_museum($id) {
        try{
        DAL_Museum::delete_artist_work($id);
        DAL_Museum::delete_works_rooms($id);
        DAL_Museum::delete_events_artists($id);
        DAL_Museum::delete_events($id);
        DAL_Museum::delete_rooms($id);
        DAL_Museum::delete_works($id);
        DAL_Museum::delete_tickets($id);
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("DELETE FROM museum WHERE idMuseum=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();   
        $outcome=$stmt->rowCount();
        $sql = "DELETE FROM museum WHERE idMuseum='" . $id ."'"; 
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
}
?>