<h1 class="page_title"> [MUSEUMS PAGE] </h1> 
<?php
$museum_array= MuseumController::retrieve_museums();
$output='<table class="museum_table"> <tr> <th> Museum Info </th> <th> Museum Image </th> </tr>';
for ($i=0;$i<count($museum_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td> <span class=line_description> Museum Name: </span>' . $museum_array[$i]->getMuseum_name() . "</br>";
            $output = $output . '<span class=line_description> Museum Address: </span>' . $museum_array[$i]->getAddress() . "</br>";
            $output = $output . '<span class=line_description> Telephone number: </span>' . $museum_array[$i]->getTelephone_number() . "</br>";
            $output = $output . '<span class=line_description> Mail: </span>' . $museum_array[$i]->getMail() . "</br>";
            $output = $output . '<span class=line_description> Info: </span>' . $museum_array[$i]->getMuseum_info() . "</br> </td>";
            $output = $output . '<td> <img class="museum_image" src="'. $museum_array[$i]->getMuseum_image() .'"> </td>';
            $output = $output . '</tr>';    
}
$output= $output . "</table>";
echo $output;
?>


