<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TicketController
 *
 * @author domis
 */
class TicketController {

    public static function process() {
        //echo 'Ticket Controller Called <br>';
        
        if (isset($_POST['create_ticket'])) {
           $a_ticket=new Ticket("",$_POST['new_ticket_type'],$_POST['new_ticketperson_name'],$_POST['new_ticketevent_id'],$_POST['new_ticketbuyer_id'],$_POST['new_ticketpurchase_date'],$_POST['new_ticketvalidity_date'],$_POST['new_ticket_price']);
           $a_ticket->{'raw_create_ticket'}();
           $_SESSION['outcome']=$a_ticket->getOperation_status();
        }
         if (isset($_POST['update_ticket'])) {
           $a_ticket=new Ticket($_POST['update_ticket_id'],$_POST['update_ticket_type'],$_POST['update_ticketperson_name'],$_POST['update_ticketevent_id'],$_POST['update_ticketbuyer_id']);
           $a_ticket->{'update_ticket'}();
           $_SESSION['outcome']=$a_ticket->getOperation_status();
        }
         if (isset($_POST['delete_ticket'])) {
           $a_ticket=new Ticket($_POST['delete_ticket_id']);
           $a_ticket->{'delete_ticket'}();
           $_SESSION['outcome']=$a_ticket->getOperation_status();
        }
        
         if (isset($_POST['pay_ticket'])) {
            $a_ticket=new Ticket("",$_POST['ticket_type'],$_POST['owner_name'] . "-" . $_POST['document_id'],$_POST['event_name'],$_SESSION['user_id'],date ("Y-m-d H:i:s"));
            $a_ticket->{'create_ticket'}();
            $_SESSION['outcome']=$a_ticket->getOperation_status();
            if ($_SESSION['outcome']==0) {
                $a_ticket->{'send_ticket'}($_SESSION['user_mail']);
                }
        }
    }
    
        public static function retrieve_tickets() {
            return Ticket::retrieve_tickets();
        }
        
        public static function bought_tickets($userID) {
            return Ticket::bought_tickets($userID);
        }
}
