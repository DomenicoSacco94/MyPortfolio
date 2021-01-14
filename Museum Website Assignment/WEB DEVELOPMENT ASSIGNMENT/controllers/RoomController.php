<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoomController
 *
 * @author domis
 */
class RoomController {
    public static function process() {
        //echo 'Room Controller Called <br>';
         if (isset($_POST['create_room'])) {
           $a_room=new Room("",$_POST['new_room_floor'],$_POST['new_room_number'],$_POST['new_room_name'],$_POST['new_room_description'],$_POST['new_room_museum_id'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_room->{'create_room'}();
           $_SESSION['outcome']=$a_room->getOperation_status();
        }
         if (isset($_POST['update_room'])) {
           $a_room=new Room($_POST['update_room_id'],$_POST['update_room_floor'],$_POST['update_room_number'],$_POST['update_room_name'],$_POST['update_room_description'],$_POST['update_room_museum_id'],$_FILES["uploadedfile"]["name"],$_FILES["uploadedfile"]["tmp_name"]);
           $a_room->{'update_room'}();
           $_SESSION['outcome']=$a_room->getOperation_status();
        }
         if (isset($_POST['delete_room'])) {
           $a_room=new Room($_POST['delete_room_id']);
           $a_room->{'delete_room'}();
           $_SESSION['outcome']=$a_room->getOperation_status();
        }
    }
        public static function retrieve_rooms() {
            return Room::retrieve_rooms();
        }
        
        public static function retrieve_rooms_for_museums() {
            return Room::retrieve_rooms_for_museums();
        }
        
}
