<?php
$event_array = EventController::retrieve_events_bar();
$output="";
for ($i=0;$i<count($event_array);$i++) {
            $output = $output . '<li class="event_container">'; 
            $output = $output . '<div class="event_info">';
            $output = $output . '<h2 class="event_title">' . $event_array[$i]->getMuseum_name() .'</h2> <h4>' . $event_array[$i]->get_Event_name() . "</h4>";
            $output = $output . '<img class="event_icon" src="'. $event_array[$i]->getEvent_image() .'">';
            $output = $output . '<div class="event_date">' . $event_array[$i]->get_start_date() . '<br>' . $event_array[$i]->get_end_date() . '</div>';
            $output = $output . '<div class="event_description" >';
            $output = $output . 'Places: ' . $event_array[$i]->get_max_tickets(). "<br>";
            $output = $output . 'Full: ' . $event_array[$i]->get_full_price(). "$<br>";
            $output = $output . 'Student: ' . $event_array[$i]->get_student_price() . "$<br>";
            $output = $output . 'Reduced: ' . $event_array[$i]->get_reduced_price() . "$<br>";
            $output = $output . '<div class="event_exp">' . $event_array[$i]->get_Event_info() . "</div>";
            $output = $output . '</div> </div> </li>';
}
echo $output;
?>