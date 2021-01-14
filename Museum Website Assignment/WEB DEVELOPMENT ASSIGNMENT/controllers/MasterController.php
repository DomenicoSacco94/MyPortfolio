<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterController
 *
 * @author domis
 */
require_once 'TicketController.php';
require_once 'VisitorController.php';
require_once 'UserController.php';
require_once 'AdministratorController.php';
require_once 'ArtistController.php';
require_once 'EventController.php';
require_once 'WorkController.php';
require_once 'MuseumController.php';
require_once 'RoomController.php';
require_once 'Work_ArtistController.php';
require_once 'Event_ArtistController.php';
require_once 'Website_VisitorController.php';

class MasterController {
    //put your code here
    
    public static function process() {
       //echo 'Master Controller Called <br>';
       AdministratorController::create_predef_admin();
       VisitorController::process();
       
       if(isset($_GET['category'])) {
       if ($_GET['category']=='ticket') {
		TicketController::process();
	}
       if ($_GET['category']=='user') {
		UserController::process();
	}
       if ($_GET['category']=='administrator') {
		AdministratorController::process();
	}      
       if ($_GET['category']=='artist') {
		ArtistController::process();
	}    
       if ($_GET['category']=='event') {
		EventController::process();
	}     
       if ($_GET['category']=='work') {
		WorkController::process();
	}   
       if ($_GET['category']=='museum') {
		MuseumController::process();
	} 
       if ($_GET['category']=='room') {
		RoomController::process();
	} 
       if ($_GET['category']=='artist_work') {
		Work_ArtistController::process();
	} 
       if ($_GET['category']=='event_artist') {
		Event_ArtistController::process();
	} 
       if ($_GET['category']=='website_visitor') {
           Website_VisitorController::process();
	} 
       }
       //name= $_POST['name';
       //$category= new Category($name);
       //$category->create();
    }
    
}
