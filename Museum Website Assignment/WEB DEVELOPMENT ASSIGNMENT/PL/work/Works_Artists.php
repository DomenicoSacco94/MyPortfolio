<h1 class="page_title"> [WORKS AND ARTISTS PAGE] </h1> 
<?php
$work_array= WorkController::retrieve_works_for_artists();
$output='<table class="work_table"> <tr> <th> Work Info (by Artist) </th> <th> Work Picture </th> </tr>';
for ($i=0;$i<count($work_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td> <span class=line_description> Artist Name: </span>' . $work_array[$i]->getArtist_name() . "</br>";
            $output = $output . '<span class=line_description> Work Name: </span>' . $work_array[$i]->getWork_name() . "</br>";
            $output = $output . '<span class=line_description> Material: </span>' . $work_array[$i]->getMaterial() . "</br>";
            $output = $output . '<span class=line_description> Type: </span>' . $work_array[$i]->getType() . "</br>";
            $output = $output . '<span class=line_description> Date: </span>' . $work_array[$i]->getDate() . "</br>";
            $output = $output . '<span class=line_description> Description: </span>' . $work_array[$i]->getWork_description() . "</br>";
            $output = $output . '<span class=line_description> Room Name: </span>' . $work_array[$i]->getRoom_name() . "</br> </td>";
            $output = $output . "<td>" . '<img class="work_image" src="'. $work_array[$i]->getWork_image() .'"> </td>';
            $output = $output . '</tr>';   
}
$output= $output . "</table>";
echo $output;
?>
