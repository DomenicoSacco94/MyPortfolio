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
class ArtistController {
     public static function process() {
        //echo 'Artist Controller Called <br>';
         if (isset($_POST['create_artist'])) {
           $a_artist=new Artist("",$_POST['new_artist_name'],$_POST['new_artist_description'],$_POST['new_artist_born'],$_POST['new_artist_death'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_artist->{'create_artist'}();
           $_SESSION['outcome']=$a_artist->getOperation_status();
        }
         if (isset($_POST['update_artist'])) {
           $a_artist=new Artist($_POST['updated_artist_id'],$_POST['updated_artist_name'],$_POST['updated_artist_description'],$_POST['updated_artist_born'],$_POST['updated_artist_death'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_artist->{'update_artist'}();
           $_SESSION['outcome']=$a_artist->getOperation_status();
        }
         if (isset($_POST['delete_artist'])) {
           $a_artist=new Artist($_POST['delete_artist_id']);
           $a_artist->{'delete_artist'}();
           $_SESSION['outcome']=$a_artist->getOperation_status();
        }
    }
        public static function retrieve_artists() {
            return Artist::retrieve_artists();
        }
        
        public static function retrieve_artists_user() {
            return Artist::retrieve_artists_user();
        }
}
