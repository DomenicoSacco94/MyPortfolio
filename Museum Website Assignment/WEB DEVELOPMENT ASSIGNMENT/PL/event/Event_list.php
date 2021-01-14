<?php
$event_array = EventController::retrieve_events();
$output='<table class="event_table"> <tr> <th> Event ID </th> <th> Event Name </th> <th> Start Date </th> <th> End date </th> <th> Max tickets </th> <th> Normal </th> <th> Student </th> <th> Reduced </th> <th> Info </th> <th> Museum Name </th> <th> Event Image </th> </tr>';
for ($i=0;$i<count($event_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $event_array[$i]->get_idEvent() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_Event_name() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_start_date() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_end_date() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_max_tickets(). "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_full_price(). "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_student_price() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_reduced_price() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->get_Event_info() . "</td>";
            $output = $output . '<td>' . $event_array[$i]->getMuseum_name() . "</td>";
            $output = $output . '<td> <img class="event_image" src="'. $event_array[$i]->getEvent_image() .'"> </td>';
            $output = $output . '</tr>';        
}
$output= $output . "</table>";
echo $output;
?>
