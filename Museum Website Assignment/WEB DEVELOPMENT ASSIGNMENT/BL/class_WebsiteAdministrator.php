<?php 

require_once(".\DAL\DAL_WebsiteUser.php");
require_once(".\BL\class_WebsiteUser.php");
require_once(".\DAL\DAL_WebsiteAdministrator.php");

class Website_Administrator extends Website_User { 

    public function __construct()
    {
        parent::__construct(...func_get_args());
    }
    
    function register_admin() {
        $this->operation_status = DAL_Website_Administrator::{"register_admin"}($this->login,$this->password,$this->User_name,$this->mail);
        return $this->operation_status;
    }
    
    static function retrieve_users() {
        $users = DAL_Website_Administrator::{"retrieve_users"}();
        return $users;
    }
    
    function delete_user() {
        $this->operation_status=DAL_Website_Administrator::{"delete_user"}($this->idUser);
        return $this->operation_status;
    }
    
    static function create_predef_admin() {
        DAL_Website_Administrator::{"create_predef_admin"}();
    }
}
?>
