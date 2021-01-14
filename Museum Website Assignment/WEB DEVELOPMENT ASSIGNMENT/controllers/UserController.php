<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author domis
 */
class UserController {
     public static function process() {
        //echo 'User Controller Called <br>';
         if (isset($_POST['change_description'])) {
           $a_user=new Website_User($_SESSION['user_id']);
           $a_user->update_description($_SESSION['user_id'], $_POST['new_description']);
           $_SESSION['outcome']=$a_user->getOperation_status();
           //echo "***" . $_SESSION['outcome'];
        }
         if (isset($_POST['change_username'])) {
           $a_user=new Website_User($_SESSION['user_id']);
           $a_user->update_username($_SESSION['user_id'], $_POST['new_username']);
           $_SESSION['outcome']=$a_user->getOperation_status();
        }
         if (isset($_POST['change_password'])) {
           $a_user=new Website_User($_SESSION['user_id']);
           $a_user->update_password($_SESSION['user_id'], $_POST['new_password']);
           $_SESSION['outcome']=$a_user->getOperation_status();
        }
    }
}
