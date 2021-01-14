<?php
$work_array= WorkController::retrieve_works();
$output='<table class="work_table"> <tr> <th> Work ID </th> <th> Work Name </th> <th> Work Material </th> <th> Work type </th> <th> Realization date </th> <th> Work Description </th> <th> Room Name </th> <th> Work Picture </th> </tr>';
for ($i=0;$i<count($work_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . "<td>" . $work_array[$i]->getIdWork() . "</td>";
            $output = $output . "<td>" . $work_array[$i]->getWork_name(). "</td>";
            $output = $output . "<td>" . $work_array[$i]->getMaterial() . "</td>";
            $output = $output . "<td>" . $work_array[$i]->getType() . "</td>";
            $output = $output . "<td>" . $work_array[$i]->getDate() . "</td>";
            $output = $output . "<td>" . $work_array[$i]->getWork_description() . "</td>";
            $output = $output . "<td>" . $work_array[$i]->getRoom_name() . "</td>";
            $output = $output . "<td>" . '<img class="work_image" src="'. $work_array[$i]->getWork_image() .'"> </td>';
            $output = $output . '</tr>';    
}
$output= $output . "</table>";
echo $output;
?>
