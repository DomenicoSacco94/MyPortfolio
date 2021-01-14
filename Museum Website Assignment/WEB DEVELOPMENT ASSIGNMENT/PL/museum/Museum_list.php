<?php
$museum_array= MuseumController::retrieve_museums();
$output='<table class="museum_table"> <tr> <th> Museum Name </th> <th> Museum ID </th> <th> Address </th> <th> Telephone </th> <th> Mail </th> <th> Info </th> <th> Museum Image </th> </tr>';
for ($i=0;$i<count($museum_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $museum_array[$i]->getMuseum_name() . "</td>";
            $output = $output . '<td>' . $museum_array[$i]->getIdMuseum() . "</td>";
            $output = $output . '<td>' . $museum_array[$i]->getAddress() . "</td>";
            $output = $output . '<td>' . $museum_array[$i]->getTelephone_number() . "</td>";
            $output = $output . '<td>' . $museum_array[$i]->getMail() . "</td>";
            $output = $output . '<td>' . $museum_array[$i]->getMuseum_info() . "</td>";
            $output = $output . '<td> <img class="museum_image" src="'. $museum_array[$i]->getMuseum_image() .'"> </td>';
            $output = $output . '</tr>';    
}
$output = $output . "</table>";
echo $output;
?>
