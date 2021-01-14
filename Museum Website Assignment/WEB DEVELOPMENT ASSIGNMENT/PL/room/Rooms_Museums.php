<h1 class="page_title"> [ROOMS AND MUSEUMS PAGE] </h1> 
<?php
$room_array = RoomController::retrieve_rooms_for_museums();
$output='<table class="room_table"> <tr> <th> Room Info </th> <th> Room Picture </th> </tr>';
for ($i=0;$i<count($room_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td> <span class=line_description> Museum name: </span>' . $room_array[$i]->getMuseum_name() . "</br>";
            $output = $output . '<span class=line_description> Floor: </span>' . $room_array[$i]->getFloor() . "</br>";
            $output = $output . '<span class=line_description> Room Number: </span>' . $room_array[$i]->getNumber() . "</br>";
            $output = $output . '<span class=line_description> Room name: </span>' . $room_array[$i]->getRoom_name() . "</br>";
            $output = $output . '<span class=line_description> Description: </span>' . $room_array[$i]->getRoom_Description() . "</br> </td>";
            $output = $output . '<td> <img class="museum_image" src="'. $room_array[$i]->getRoom_image() .'"> </td>';
            $output = $output . '</tr>';
}
$output= $output . "</table>";
echo $output;
?>
