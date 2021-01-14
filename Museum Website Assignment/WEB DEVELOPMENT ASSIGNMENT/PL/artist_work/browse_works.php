<?php
$work_array= WorkController::retrieve_works();
$output="";
for ($i=0;$i<count($work_array);$i++) {
            $output = $output . '<option value="' . $work_array[$i]->getWork_name() . '">' . $work_array[$i]->getWork_name() . "</option>"; 
}
echo $output;
?>
