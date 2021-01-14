<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAL_Website_User { 
    
    static function already_registered($login) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("SELECT * FROM user WHERE login=:login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}
    }
    
    static function already_is($id,$login) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("SELECT login FROM user WHERE idUser=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $previous_login=$stmt->fetchColumn();
    if ($login==$previous_login) {return false;}
    else {
    $stmt = $conn->prepare("SELECT * FROM user WHERE login=:login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}
    }
    }
    
    static function delete_tickets($id) {
    $db_conn=new DB();
    $conn=$db_conn->connect(); 
    $stmt = $conn->prepare("DELETE FROM ticket WHERE BuyerID=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $outcome=$stmt->rowCount();
    if ($outcome !== 0 ) {return true;}
    else {return false;}           
    }
    
    function generate_password() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_array=str_split($characters);
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $position=rand(0, strlen($characters)-1);
        $next_char=$characters_array[$position];
        $randstring = $randstring . $next_char;
    }
    return $randstring;
        }
        
    function send_resetmail($mail,$new_password) {
            $msg = "Hello, it seems that you had troubles with your password, it has been reset to: <br> <br> <b>" . $new_password ."</b> <br> <br> Best Regards, <br> Your Favourite Museum";

            // use wordwrap() if lines are longer than 70 characters
               $msg = wordwrap($msg,70);

            // send email
               $headers = 'From: webmaster@whateverdomain.com' . "\r\n" .
    'Reply-To: webmaster@whateverdomain.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=UTF-8\r\n";
               $outcome=mail($mail,"Museum website password reset",$msg,$headers);
        }
        
    static function register($login,$password,$name,$mail) {
        try{
        $password=sha1($password);
        $db_conn=new DB();
        $conn=$db_conn->connect();
        if(!(DAL_Website_User::already_registered($login))) {
        $stmt = $conn->prepare("INSERT INTO user (login,password,User_name,mail,admin) VALUES (:login,:password,:name,:mail,0)");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();
        $sql = "INSERT INTO user (login,password,User_name,mail,admin) VALUES ('".$login."','".$password."','".$name."','".$mail."',0)";   
        //echo "<br> SQL Statement: <br>" . $sql;    
        $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
        $conn = null; 
        if( $outcome !== 0) {return 0;}
        else {return 1;}
        } else {return 4;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
    static function authenticate($login,$password) {
        try{
        $password=sha1($password);
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("SELECT * FROM user WHERE login=:login AND password =:password");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Website_User'); 
        $sql="SELECT * FROM user WHERE login='" .$login. "' AND password ='".$password ."'";    
        //echo "<br> SQL Statement: <br>" . $sql;
        while ($user=$stmt->fetch()) {
            $array[0]= $user->getIdUser();
            $array[1]= $user->getUser_name();
            $array[2]= $user->getAdmin();
            $array[3]= $user->getMail();
            $array[4]= $user->getUser_description();
            
        }
        $rows=$stmt->rowCount();
        if ($rows!==0) {$array[5]=0;}
        else {$array=["","","","","",8];}
        $stmt->closeCursor();
        $conn = null; 
        return $array;
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function reset_password($mail) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $new_password_enc="";
        $new_password=self::generate_password();
        $new_password_enc=sha1($new_password);
        $stmt = $conn->prepare("UPDATE user SET password=:password WHERE mail=:mail");
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":password", $new_password_enc); 
        $stmt->execute();
        //echo "<br> SQL Statement: <br>" . $sql;
        $outcome=$stmt->rowCount();
        $conn = null; 
        self::send_resetmail($mail,$new_password);
        if ($outcome !== 0) {return $new_password;}
        else {return 0;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
        }
        
        static function update_user($userID,$login,$password,$name,$mail) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $password=sha1($password);
        if(!(DAL_Website_User::already_is($userID,$login))) {
        $stmt = $conn->prepare("UPDATE user SET login=:login,password=:password,User_name=:name,mail=:mail WHERE idUser=:id");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":id", $userID);
        $stmt->execute();        
        $sql="UPDATE user SET login=:login,password=:password,User_name=:name,mail=:mail WHERE idUser=:id";      
        //echo "<br> SQL Statement: <br>" . $sql;
         $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
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
    
    static function update_username($userID,$name) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("UPDATE user SET User_name=:name WHERE idUser=:id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id", $userID);
        $stmt->execute();        
        $sql="UPDATE user SET User_name=:name WHERE idUser=:id";      
        //echo "<br> SQL Statement: <br>" . $sql;
         $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
        $conn = null; 
        if($outcome !== 0) {return 0;}
        else {return 2;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function update_password($userID,$password) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $password=sha1($password);
        $stmt = $conn->prepare("UPDATE user SET password=:password WHERE idUser=:id");
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":id", $userID);
        $stmt->execute();        
        $sql="UPDATE user SET password=:password WHERE idUser=:id";      
        //echo "<br> SQL Statement: <br>" . $sql;
         $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
        $conn = null; 
        if($outcome !== 0) {return 0;}
        else {return 2;}
        }
        catch(Exception $e){
        echo "ERROR <br>";
        echo $e->getMessage();
        }
    }
    
        static function update_description($userID,$description) {
        try{
        $db_conn=new DB();
        $conn=$db_conn->connect();
        $stmt = $conn->prepare("UPDATE user SET user_description=:description WHERE idUser=:id");
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $userID);
        $stmt->execute();        
        $sql="UPDATE user SET user_description=:description WHERE idUser= ". $userID ;      
        //echo "<br> SQL Statement: <br>" . $sql;
         $outcome=$stmt->rowCount();
        //echo "<br> Affected rows: " .$outcome;
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