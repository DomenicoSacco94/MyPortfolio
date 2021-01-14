<?php 

require_once(".\DAL\DAL_Ticket.php");
        
class Ticket { 
    private $idTicket;
    private  $type; 
    private  $person_name; 
    private  $purchase_date; 
    private  $validity_date; 
    private  $price;
    private  $Event_idEvent;
    private  $Event_name;
    private  $BuyerID;
    private $operation_status=0;
    
    function getEvent_name() {
        return $this->Event_name;
    }

    function setEvent_name($Event_name) {
        $this->Event_name = $Event_name;
    }

        function __construct($idTicket=null, $type=null, $person_name=null, $Event_name=null, $BuyerID=null,  $purchase_date=null, $validity_date=null, $price=null, $operation_status=null) {
        $this->idTicket = $idTicket;
        $this->type = $type;
        $this->person_name = $person_name;
        $this->purchase_date = $purchase_date;
        $this->validity_date = $validity_date;
        $this->price = $price;
        $this->Event_name = $Event_name;
        $this->BuyerID = $BuyerID;
        $this->operation_status = $operation_status;
    }

    function setIdTicket($idTicket) {
        $this->idTicket = $idTicket;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setPerson_name($person_name) {
        $this->person_name = $person_name;
    }

    function setPurchase_date($purchase_date) {
        $this->purchase_date = $purchase_date;
    }

    function setValidity_date($validity_date) {
        $this->validity_date = $validity_date;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setEvent_idEvent($Event_idEvent) {
        $this->Event_idEvent = $Event_idEvent;
    }

    function setBuyerID($BuyerID) {
        $this->BuyerID = $BuyerID;
    }

    function setOperation_status($operation_status) {
        $this->operation_status = $operation_status;
    }

    function getOperation_status() {
        return $this->operation_status;
    }

        function getType() {
        return $this->type;
    }

    function getPrice() {
        return $this->price;
    }
    
    function getidTicket() {
        return $this->idTicket;
    }
    
    function getPerson_name() {
        return $this->person_name;
    }

    function getPurchase_date() {
        return $this->purchase_date;
    }

    function getValidity_date() {
        return $this->validity_date;
    }

    function getEvent_idEvent() {
        return $this->Event_idEvent;
    }

    function getBuyerID() {
        return $this->BuyerID;
    }

    function create_ticket() {
    $array=DAL_Ticket::{"create_ticket"}($this->type,$this->person_name,$this->Event_name,$this->BuyerID);
    $this->operation_status=$array[0];
    $this->purchase_date=$array[1];
    $this->validity_date=$array[2];
    $this->price=$array[3];
   } 
   
    function send_ticket($mail) {
            $msg = "Hello, this is the ticket you bought: <br> <br>";
            $msg .= '<b> Event Name: </b>' . $this->Event_name . '  <br>';
            $msg .= '<b> Event Date: </b>' . $this->validity_date . '<br>';
            $msg .= '<b> Customer name and ID: </b>' . $this->person_name. '<br>';
            $msg .= '<b> Ticket Price: </b>' . $this->price. '$<br>';
                $msg .= '<b> Purchase Date: </b>' . $this->purchase_date . '<br>';
            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            // send email
               $headers = 'From: webmaster@whateverdomain.com' . "\r\n" .
    'Reply-To: webmaster@whateverdomain.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=UTF-8\r\n";
               $outcome=mail($mail,"Museum website ticket",$msg,$headers);
        }
        
    function raw_create_ticket() {
    $array=DAL_Ticket::{"raw_create_ticket"}($this->type,$this->person_name,$this->Event_name,$this->BuyerID,$this->purchase_date,$this->validity_date,$this->price);
    $this->operation_status=$array[0];
   } 
   
    static function retrieve_tickets() {  
    $tickets=DAL_Ticket::{"retrieve_tickets"}();   
    return $tickets;
    }
    
    static function bought_tickets($BuyerID) {  
    $tickets=DAL_Ticket::{"bought_tickets"}($BuyerID);   
    return $tickets;
    }
    
    function delete_ticket() {  
    $this->operation_status=DAL_Ticket::{"delete_ticket"}($this->idTicket);    
    }
    
    function update_ticket() {  
    $this->operation_status=DAL_Ticket::{"update_ticket"}($this->idTicket,$this->type,$this->person_name,$this->Event_name,$this->BuyerID);    
    }
    
    function get_price() {
       return $this->price;
    }
    
    function get_event_date() {
       return $this->validity_date;
    }
    
    static function occupied_places($Event_name) {
        return DAL_Ticket::get_tickets_name($Event_name) . " of " . DAL_Ticket::get_places_name($Event_name);
    }
}
?>