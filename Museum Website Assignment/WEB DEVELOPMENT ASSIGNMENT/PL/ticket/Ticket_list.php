<?php
$tickets_array=TicketController::retrieve_tickets($_SESSION['user_id']);
$output='<table class="ticket_table"> <tr> <th> Person Name </th> <th> Purchase Date </th> <th> Validity Date </th> <th> Price </th> <th> Event Name </th> <th> BuyerID </th> </tr>';
for ($i=0;$i<count($tickets_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . "<td>" . $tickets_array[$i]->getPerson_name(). "</td>";
            $output = $output . "<td>" . $tickets_array[$i]->getPurchase_date() . "</td>";
            $output = $output . "<td>" . $tickets_array[$i]->getValidity_date() . "</td>";
            $output = $output . "<td>" . $tickets_array[$i]->getPrice() . "</td>";
            $output = $output . "<td>" . $tickets_array[$i]->getEvent_name() . "</td>";
            $output = $output . "<td>" . $tickets_array[$i]->getBuyerID() . "</td>";
            $output = $output . '</tr>';    
}
$output= $output . "</table>";
echo $output;
?>
