<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Website_VisitorController
 *
 * @author domis
 */
class Website_VisitorController {
    public static function process() {
        //echo 'Visitor Tracker Controller Called <br>';
         if (isset($_POST['create_visit'])) {
           $a_visitor=new Website_Visitor("",$_POST['new_visitor_visited_page'],$_POST['new_visitor_visit_start'],$_POST['new_visitor_visit_end']);
           $a_visitor->{'save_session'}();
           $_SESSION['outcome']=$a_visitor->getOperation_result();
        }
         if (isset($_POST['update_visit'])) {
           $a_visitor=new Website_Visitor($_POST['update_visitor_id'],$_POST['update_visitor_visited_page'],$_POST['update_visitor_visit_start'],$_POST['update_visitor_visit_end']);
           $a_visitor->{'update_visit'}();
           $_SESSION['outcome']=$a_visitor->getOperation_result();
        }
         if (isset($_POST['delete_visit'])) {
           $a_visitor=new Website_Visitor($_POST['delete_visitor_id']);
           $a_visitor->{'delete_visit'}();
           $_SESSION['outcome']=$a_visitor->getOperation_result();
        }
    }
        public static function retrieve_visitors() {
            return Website_Visitor::retrieve_visits();
        }
}
