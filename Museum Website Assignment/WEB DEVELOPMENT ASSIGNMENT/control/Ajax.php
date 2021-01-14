<?php
require_once dirname(__FILE__).'/../BL/class_WebsiteVisitor.php';
require_once dirname(__FILE__).'/../DAL/DAL_WebsiteVisitor.php';
require_once dirname(__FILE__).'/../DB/DB_class.php';

$session = json_decode(file_get_contents('php://input'), true);
$a_visitor=new Website_Visitor("",$session['visited_page'],$session['visit_start'],$session['visit_end'],$session['visitor_identifier']);
$a_visitor->{'save_session'}();
$_SESSION['outcome']=$a_visitor->getOperation_result();
$msg['outcome']="success";
echo json_encode($msg); 
?>
