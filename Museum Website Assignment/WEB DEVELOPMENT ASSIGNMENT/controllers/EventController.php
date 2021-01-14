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
class EventController {
     public static function process() {
        //echo 'Event Controller Called <br>';
         if (isset($_POST['create_event'])) {
           $a_event=new Event("",$_POST['new_event_startdate'],$_POST['new_event_enddate'],$_POST['new_event_name'],$_POST['new_event_max_tickets'],$_POST['new_event_full_price'],$_POST['new_event_student_price'],$_POST['new_event_reduced_price'],$_POST['new_event_info'],$_POST['new_event_museum_id'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_event->{'create_event'}();
           $_SESSION['outcome']=$a_event->getOperation_status();
        }
         if (isset($_POST['update_event'])) {
           $a_event=new Event($_POST['update_event_id'],$_POST['update_event_startdate'],$_POST['update_event_enddate'],$_POST['update_event_name'],$_POST['update_event_max_tickets'],$_POST['update_event_full_price'],$_POST['update_event_student_price'],$_POST['update_event_reduced_price'],$_POST['update_event_info'],$_POST['update_event_museum_id'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_event->{'update_event'}();
           $_SESSION['outcome']=$a_event->getOperation_status();
        }
         if (isset($_POST['delete_event'])) {
           $a_event=new Event($_POST['delete_event_id']);
           $a_event->{'delete_event'}();
           $_SESSION['outcome']=$a_event->getOperation_status();
        }
    }
        public static function retrieve_events() {
            return Event::retrieve_events();
        }
        
        public static function retrieve_events_bar() {
            return Event::retrieve_events_bar();
        }
}
