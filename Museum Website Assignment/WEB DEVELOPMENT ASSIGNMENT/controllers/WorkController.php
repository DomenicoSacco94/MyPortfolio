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
class WorkController {
     public static function process() {
        //echo 'Work Controller Called <br>';
         if (isset($_POST['create_work'])) {
           $a_work=new Work("",$_POST['new_work_name'],$_POST['new_work_material'],$_POST['new_work_type'],$_POST['new_work_date'],$_POST['new_work_description'],$_POST['new_work_roomID'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_work->{'create_work'}();
           $_SESSION['outcome']=$a_work->getOperation_status();
        }
         if (isset($_POST['update_work'])) {
           $a_work=new Work($_POST['updated_work_id'],$_POST['updated_work_name'],$_POST['updated_work_material'],$_POST['updated_work_type'],$_POST['updated_work_date'],$_POST['updated_work_description'],$_POST['updated_work_roomID'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_work->{'update_work'}();
           $_SESSION['outcome']=$a_work->getOperation_status();
        }
         if (isset($_POST['delete_work'])) {
           $a_work=new Work($_POST['delete_work_id']);
           $a_work->{'delete_work'}();
           $_SESSION['outcome']=$a_work->getOperation_status();
        }
    }
        public static function retrieve_works() {
            return Work::retrieve_works();
        }
        
        public static function retrieve_works_for_artists() {
            return Work::retrieve_works_for_artists();
        }
        
        public static function retrieve_works_for_rooms() {
            return Work::retrieve_works_for_rooms();
        }
}
