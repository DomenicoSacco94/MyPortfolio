<?php
$event_array= EventController::retrieve_events();
$output="";
for ($i=0;$i<count($event_array);$i++) {
            $output = $output . '<option value="' . $event_array[$i]->get_Event_name() . '">' . $event_array[$i]->get_Event_name() . "</option>";
}
echo $output;
?>