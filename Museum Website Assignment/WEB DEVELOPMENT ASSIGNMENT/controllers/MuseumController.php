<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArtistController
 *
 * @author domis
 */
class MuseumController {
     public static function process() {
        //echo 'Museum Controller Called <br>';
         if (isset($_POST['create_museum'])) {
           $a_museum=new Museum("",$_POST['new_museum_name'],$_POST['new_museum_address'],$_POST['new_museum_telephone'],$_POST['new_museum_mail'],$_POST['new_museum_info'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_museum->{'create_museum'}();
           $_SESSION['outcome']=$a_museum->getOperation_status();
        }
         if (isset($_POST['update_museum'])) {
           $a_museum=new Museum($_POST['updated_museum_id'],$_POST['updated_museum_name'],$_POST['updated_museum_address'],$_POST['updated_museum_telephone'],$_POST['updated_museum_mail'],$_POST['updated_museum_info'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_museum->{'update_museum'}();
           $_SESSION['outcome']=$a_museum->getOperation_status();
        }
         if (isset($_POST['delete_museum'])) {
           $a_museum=new Museum($_POST['delete_museum_id']);
           $a_museum->{'delete_museum'}();
           $_SESSION['outcome']=$a_museum->getOperation_status();
        }
    }
        public static function retrieve_museums() {
            return Museum::retrieve_museums();
        }
}
