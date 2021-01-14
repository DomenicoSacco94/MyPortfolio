<h1 class="page_title"> [EVENTS PAGE] </h1> 
<?php
$event_array = EventController::retrieve_events();
$output='<table class="event_table"> <tr> <th> Event Info </th> <th> Event Image </th> </tr>';
for ($i=0;$i<count($event_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td> <span class=line_description> Event Name: </span>' . $event_array[$i]->get_Event_name() . "</br>";
            $output = $output . '<span class=line_description> Start Date: </span>' . $event_array[$i]->get_start_date() . "</br>";
            $output = $output . '<span class=line_description> End Date: </span>' . $event_array[$i]->get_end_date() . "</br>";
            $output = $output . '<span class=line_description> Max Tickets: </span>' . $event_array[$i]->get_max_tickets(). "</br>";
            $output = $output . '<span class=line_description> Full Price: </span>' . $event_array[$i]->get_full_price(). "$</br>";
            $output = $output . '<span class=line_description> Student Price: </span>' . $event_array[$i]->get_student_price() . "$</br>";
            $output = $output . '<span class=line_description> Reduced Price: </span>' . $event_array[$i]->get_reduced_price() . "$</br>";
            $output = $output . '<span class=line_description> Event Info: </span>' . $event_array[$i]->get_Event_info() . "</br>";
            $output = $output . '<span class=line_description> Museum name: </span>' . $event_array[$i]->getMuseum_name() . "</br> </td>";
            $output = $output . '<td> <img class="event_image" src="'. $event_array[$i]->getEvent_image() .'"> </td>';
            $output = $output . '</tr>';        
}
$output= $output . "</table>";
echo $output;
?>



