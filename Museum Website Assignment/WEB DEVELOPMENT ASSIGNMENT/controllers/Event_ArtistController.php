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
class Event_ArtistController {
     public static function process() {
        //echo 'Event Artist Controller Called <br>';
         if (isset($_POST['create_participation'])) {
           $a_event_artist=new Event_Artist($_POST['new_artist_name'],$_POST['new_event_name'],$_POST['new_contribution_start'],$_POST['new_contribution_end'],$_POST['new_participation_details']);
           $a_event_artist->{'create_event_artist'}();
           $_SESSION['outcome']=$a_event_artist->getOperation_status();
        }
         if (isset($_POST['update_participation'])) {
           $a_event_artist=new Event_Artist($_POST['update_artist_name'],$_POST['update_event_name'],$_POST['update_contribution_start'],$_POST['update_contribution_end'],$_POST['update_participation_details']);
           $a_event_artist->{'update_event_artist'}();
           $_SESSION['outcome']=$a_event_artist->getOperation_status();
        }
         if (isset($_POST['delete_participation'])) {
           $a_event_artist=new Event_Artist($_POST['delete_artist_name'],$_POST['delete_event_name']);
           $a_event_artist->{'delete_event_artist'}();
           $_SESSION['outcome']=$a_event_artist->getOperation_status();
        }
    }
        public static function retrieve_event_artists() {
            return Event_Artist::retrieve_event_artists();
        }
        
        public static function retrieve_events_for_artists() {
            return Event_Artist::retrieve_events_for_artists();
        }
}
