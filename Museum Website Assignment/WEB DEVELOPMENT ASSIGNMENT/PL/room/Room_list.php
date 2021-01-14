<?php
$room_array = RoomController::retrieve_rooms();
$output='<table class="room_table"> <tr> <th> Museum Name </th> <th> Room ID </th> <th> Floor </th> <th> Room Number </th> <th> Room Name </th> <th> Room Description </th> <th> Room Picture </th> </tr>';
for ($i=0;$i<count($room_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $room_array[$i]->getMuseum_name() . "</td>";
            $output = $output . '<td>' . $room_array[$i]->getIdRoom() . "</td>";
            $output = $output . '<td>' . $room_array[$i]->getFloor() . "</td>";
            $output = $output . '<td>' . $room_array[$i]->getNumber() . "</td>";
            $output = $output . '<td>' . $room_array[$i]->getRoom_name() . "</td>";
            $output = $output . '<td>' . $room_array[$i]->getRoom_Description() . "</td>";
            $output = $output . '<td> <img class="museum_image" src="'. $room_array[$i]->getRoom_image() .'"> </td>';
            $output = $output . '</tr>';
}
$output= $output . "</table>";
echo $output;
?>
