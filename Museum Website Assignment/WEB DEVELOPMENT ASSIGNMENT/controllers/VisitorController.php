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

class VisitorController {
        public static function process() {
        //echo 'Visitor Controller Called <br>';
         if (isset($_POST['login_submit'])) {
            $a_user= new Website_User("",$_POST['username'],$_POST['password']);
            $_SESSION['outcome']=$a_user->{"authenticate"}();
            $_SESSION['user_id']= $a_user->getIdUser();
            $_SESSION['user_name']= $a_user->getUser_name();
            $_SESSION['user_mail']= $a_user->getMail();
            $_SESSION['password']= $_POST['password'];
            $_SESSION['user_description']= $a_user->getUser_description();
            $_SESSION['user_login']=$a_user->getLogin();
            $admin=$a_user->getAdmin();
            if ($_SESSION['outcome']==0) {
            if( $admin==0 ) {$_SESSION['access']=1;}
            else if ($admin==1) {$_SESSION['access']=2;}
            //echo 'Visitor logged in as User id ' . $_SESSION['user_id'] . '<br> username ' . $_SESSION['user_name'] . '<br> usermail ' . $_SESSION['user_mail'] . '<br> description ' . $_SESSION['user_description'] ;
            if ($_SESSION['access']==2) {
                //echo "<br> User is an admin <br>";
                
            }
            }
        }
         if (isset($_POST['register_submit'])) {
            if($_POST['password']==$_POST['confirmpassword']) {
            $a_user= new Website_User("",$_POST['login'],$_POST['password'],$_POST['username'],$_POST['email']);
            $a_user->{'register'}();
            $_SESSION['outcome']=$a_user->getOperation_status();
            //echo 'Visitor registered';
            }
            else {$_SESSION['outcome']=7;}
        }
         if (isset($_POST['respassword_submit'])) {
            $a_user= new Website_User("","","","",$_POST['email']);
            $a_user->{'reset_password'}();
            $_SESSION['outcome']=$a_user->getOperation_status();
            //echo 'Visitor forgot the password';
        }
    }
}
