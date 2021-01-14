<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Website_Administrator{

        static function register_admin($login,$password,$name,$mail) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $password=sha1($password);
        if(!(DAL_Website_User::already_registered($login))) {
        $sql="INSERT INTO user (login,password,User_name,mail,admin) VALUES ('".$login."','".$password."','".$name."','".$mail."',1)";
        $stmt = $conn->prepare("INSERT INTO user (login,password,User_name,mail,admin) VALUES (:login,:password,:name,:mail,1)");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();     
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
    
        static function create_predef_admin() {
        try{
        $login="DefaultAdmin";
        $password="12344321";
        $name="DefaultAdmin";
        $mail="prova@example.com";
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $password=sha1($password);
        if(!(DAL_Website_User::already_registered($login))) {
        $sql="INSERT INTO user (login,password,User_name,mail,admin) VALUES ('".$login."','".$password."','".$name."','".$mail."',1)";
        $stmt = $conn->prepare("INSERT INTO user (login,password,User_name,mail,admin) VALUES (:login,:password,:name,:mail,1)");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();     
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
        
        static function retrieve_users() {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Website_User'); 
        $sql = "SELECT * from user";
        $users_array = [];
        $index=0;
        while ($user=$stmt->fetch()) {
            $users_array[$index]=$user;
            $index++;
        }   
        //echo "<br> SQL Statement: <br> " . $sql;
        $stmt->closeCursor();        
        $conn = null; 
        return $users_array;
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function delete_user($id) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        DAL_Website_User::delete_tickets($id);
        $stmt = $conn->prepare("DELETE FROM user WHERE idUser=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $sql = "DELETE FROM user WHERE idUser='" . $id ."'";
        //echo "<br> SQL Statement: <br> " . $sql;
        $conn = null; 
        $outcome=$stmt->rowCount();
        if ($outcome !== 0) {return 0;}
        else {return 3;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
} 

