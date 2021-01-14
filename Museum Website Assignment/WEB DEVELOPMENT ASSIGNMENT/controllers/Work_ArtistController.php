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
class Work_ArtistController {
     public static function process() {
        //echo 'Work Artist Controller Called <br>';
         if (isset($_POST['create_contribution'])) {
           $a_work_artist=new Artist_Work($_POST['new_artist_name'],$_POST['new_work_name'],$_POST['new_contribution']);
           $a_work_artist->{'create_artist_work'}();
           $_SESSION['outcome']=$a_work_artist->getOperation_status();
        }
         if (isset($_POST['update_contribution'])) {
           $a_work_artist=new Artist_Work($_POST['update_artist_name'],$_POST['update_work_name'],$_POST['update_contr']);
           $a_work_artist->{'update_artist_work'}();
           $_SESSION['outcome']=$a_work_artist->getOperation_status();
        }
         if (isset($_POST['delete_contribution'])) {
           $a_work_artist=new Artist_Work($_POST['delete_artist_name'],$_POST['delete_work_name']);
           $a_work_artist->{'delete_artist_work'}();
           $_SESSION['outcome']=$a_work_artist->getOperation_status();
        }
    }
        public static function retrieve_artist_works() {
            return Artist_Work::retrieve_artist_works();
        }
}
