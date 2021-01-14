<?php
$room_array=RoomController::retrieve_rooms();
for ($i=0;$i<count($room_array);$i++) {
            $output = $output . '<option value="' . $room_array[$i]->getRoom_name() . '">' . $room_array[$i]->getRoom_name() ." (" . $room_array[$i]->getMuseum_name() . ")" . "</option> <br>";            
}
echo $output;
?>

