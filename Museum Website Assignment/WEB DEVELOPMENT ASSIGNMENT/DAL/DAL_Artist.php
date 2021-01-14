<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Artist{ 
    
        static function already_registered($Artist_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT FROM artist WHERE Artist_name=:name");
        $stmt->bindParam(":name", $Artist_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
    
        static function already_is($id,$Artist_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("SELECT Artist_name FROM artist WHERE idArtist=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $previous_name=$stmt->fetchColumn();
        if ($Artist_name==$previous_name) {return false;}
        else {
        $stmt = $conn->prepare("SELECT * FROM artist WHERE Artist_name=:name");
        $stmt->bindParam(":name", $Artist_name);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}
        }
        }
    
        static function delete_participations($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM event_artist WHERE Artist_idArtist=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}               
        }
        
        static function delete_contributions($id) {
        $db_conn=new DB();
        $conn=$db_conn->connect(); 
        $stmt = $conn->prepare("DELETE FROM artist_work WHERE Artist_idArtist=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $outcome=$stmt->rowCount();
        if ($outcome !== 0 ) {return true;}
        else {return false;}        
        }
        
        static function retrieve_id_artist($Artist_name) {
        $db_conn=new DB();
        $conn=$db_conn->connect();    
        $stmt = $conn->prepare("SELECT idArtist FROM artist where Artist_name=:name");
        $stmt->bindParam(":name", $Artist_name);
        $stmt->execute();
        $id_artist="";
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Artist');
        while ($artist=$stmt->fetch()) {
            $id_artist=$artist->get_idArtist();
        }
        return $id_artist; 
        }
        
    static function create_artist($Name,$Description,$Born_date,$Death_date,$Artist_img_name,$Artist_path) {
        try{
        if(!(DAL_Artist::already_registered($Name))) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\artist\\uploads\\";
        $target_path = $target_path . basename($Artist_img_name);
        if (move_uploaded_file($Artist_path, $target_path)) {
        $Artist_data = base64_encode(file_get_contents($target_path));
        $Artist_data = 'data:image/jpg' . ';base64,' . $Artist_data;
        }
        else
        {$Artist_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("INSERT INTO artist (Artist_name,Artist_description,Born_date,Death_date,Artist_image) "
                . "VALUES (:name,:Description,:Born_date,:Death_date,:Artist_image)");
        $stmt->bindParam(":name", $Name);
        $stmt->bindParam(":Description", $Description);
        $stmt->bindParam(":Born_date", $Born_date);
        $stmt->bindParam(":Death_date", $Death_date);
        $stmt->bindParam(":Artist_image", $Artist_data);
        $stmt->execute();        
        $sql="INSERT INTO artist (Artist_name,Artist_description,Born_date,Death_date) "
                . "VALUES (".$Name.",".$Description.",".$Born_date.",".$Death_date.")"; 
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
    
        static function retrieve_artists() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM artist ORDER BY Artist_name");
        $stmt->execute();        
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Artist'); 
        $artists_array = [];
        $index=0;
        while ($work=$stmt->fetch()) {
            $artists_array[$index]=$work;
            $index++;
        }  
        $stmt->closeCursor();
        //echo "<br> SQL Statemenct: <br> " . $sql;
        $conn = null; 
        return $artists_array;
        }
        
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_artist($artistID) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        DAL_Artist::delete_participations($artistID);
        DAL_Artist::delete_contributions($artistID);
        $stmt = $conn->prepare("DELETE FROM artist WHERE idArtist=:artistid");
        $sql = "DELETE FROM artist WHERE idArtist='" . $artistID ."'";
        $stmt->bindParam(":artistid", $artistID);
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
    
    static function update_artist($idArtist,$Name,$Description,$Born_date,$Death_date,$Artist_img_name,$Artist_path) {
        try{
        if(!DAL_Artist::already_is($idArtist, $Name)) {
        $target_path = dirname(dirname(__FILE__)) . "\\PL\\artist\\uploads\\";
        $target_path = $target_path . basename($Artist_img_name);
        if (move_uploaded_file($Artist_path, $target_path)) {
        $Artist_data = base64_encode(file_get_contents($target_path));
        $Artist_data = 'data:image/jpg' . ';base64,' . $Artist_data;
        }
        else
        {$Artist_data ="";}
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("UPDATE artist SET Artist_name=:Name,Artist_description=:Description,Born_date=:Born_date,Death_date=:Death_date,Artist_image=:Artist_image WHERE idArtist=:id");
        $stmt->bindParam(":Name", $Name);
        $stmt->bindParam(":Description", $Description);
        $stmt->bindParam(":Born_date", $Born_date);
        $stmt->bindParam(":Death_date", $Death_date);
        $stmt->bindParam(":Artist_image", $Artist_data);
        $stmt->bindParam(":id", $idArtist);
        $stmt->execute();        
        $sql="UPDATE artist SET Artist_name=:Name,Artist_description=:Description,Born_date=:Born_date,Death_date=:Death_date WHERE idArtist=:id";      
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