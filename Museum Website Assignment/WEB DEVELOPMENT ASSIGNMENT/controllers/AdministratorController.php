<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministratorController
 *
 * @author domis
 */
class AdministratorController {
         public static function process() {
        //echo 'Administrator Controller Called <br>';
         if (isset($_POST['new_user'])) {
           $a_admin=new Website_Administrator("",$_POST['new_user_login'],$_POST['new_user_password'],$_POST['new_user_name'],$_POST['new_user_mail']);
           $a_admin->{'register'}();
           $_SESSION['outcome']=$a_admin->getOperation_status();
        }
         if (isset($_POST['update_user'])) {
           $a_admin=new Website_Administrator($_POST['updated_id'],$_POST['updated_user_login'],$_POST['updated_user_password'],$_POST['updated_user_name'],$_POST['updated_user_mail']);
           $a_admin->{'update_user'}();
           $_SESSION['outcome']=$a_admin->getOperation_status();
        }
         if (isset($_POST['delete_user'])) {
           $a_admin=new Website_Administrator($_POST['delete_user_id']);
           $a_admin->{'delete_user'}();
           $_SESSION['outcome']=$a_admin->getOperation_status();
        }
         if (isset($_POST['new_admin'])) {
           $a_admin=new Website_Administrator("",$_POST['admin_login'],$_POST['admin_password'],$_POST['admin_name'],$_POST['admin_mail']);
           $a_admin->{'register_admin'}();
           $_SESSION['outcome']=$a_admin->getOperation_status();
        }
    }
        public static function retrieve_users() {
            return Website_Administrator::retrieve_users();
        }
        
        public static function create_predef_admin() {
            return Website_Administrator::create_predef_admin();
        }
}
