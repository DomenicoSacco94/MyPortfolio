<?php
$museum_array= MuseumController::retrieve_museums();
$output="";
for ($i=0;$i<count($museum_array);$i++) {
            $output = $output . '<option value="' . $museum_array[$i]->getMuseum_name() . '">' . $museum_array[$i]->getMuseum_name() . "</option>";
}
echo $output;
?>

