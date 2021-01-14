<?php 

require_once(".\DAL\DAL_WebsiteUser.php");
        
class Website_User { 
    protected  $idUser;
    protected  $login; 
    protected  $password; 
    protected  $User_name;
    protected  $mail;
    protected  $admin;
    protected  $user_description;
    protected  $operation_status=0;
    
    function getUser_description() {
        return $this->user_description;
    }

    function setUser_description($user_description) {
        $this->user_description = $user_description;
    }

        function getAdmin() {
        return $this->admin;
    }

    function setAdmin($admin) {
        $this->admin = $admin;
    }

        function __construct($idUser=null, $login=null, $password=null, $User_name=null, $mail=null, $operation_status=null) {
        $this->idUser = $idUser;
        $this->login = $login;
        $this->password = $password;
        $this->User_name = $User_name;
        $this->mail = $mail;
        $this->operation_status = $operation_status;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setUser_name($User_name) {
        $this->User_name = $User_name;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setOperation_status($operation_status) {
        $this->operation_status = $operation_status;
    }

        function getOperation_status() {
        return $this->operation_status;
    }

        function getIdUser() {
        return $this->idUser;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getUser_name() {
        return $this->User_name;
    }

    function getMail() {
        return $this->mail;
    }

    function register() {
        $this->operation_status = DAL_Website_User::{"register"}($this->login,$this->password,$this->User_name,$this->mail);
        return $this->operation_status;
    }
    
    function authenticate() {
        $array = DAL_Website_User::{"authenticate"}($this->login,$this->password);
        $this->idUser=$array[0];
        $this->User_name=$array[1];
        $this->admin=$array[2];
        $this->mail=$array[3];
        $this->user_description=$array[4];
        $this->operation_status=$array[5];
        return $this->operation_status;
    }
    
    function reset_password() {
        $this->password = DAL_Website_User::{"reset_password"}($this->mail);
        return $this->password;
    }
    
    function update_user() {
        $this->operation_status=DAL_Website_User::{"update_user"}($this->idUser,$this->login,$this->password,$this->User_name,$this->mail);
        return $this->operation_status;
    }
    
    function update_username($idUser,$new_username) {
        $this->operation_status=DAL_Website_User::{"update_username"}($idUser,$new_username);
        return $this->operation_status;
    }
    
    function update_password($idUser,$new_password) {
        $this->operation_status=DAL_Website_User::{"update_password"}($idUser,$new_password);
        return $this->operation_status;
    }
    
    function update_description($idUser,$new_description) {
        $this->operation_status=DAL_Website_User::{"update_description"}($idUser,$new_description);
        return $this->operation_status;
    }
}
?>
