<?php
$user_array=AdministratorController::retrieve_users();
for ($i=0;$i<count($user_array);$i++) {
            $output = $output . '<option value="' . $user_array[$i]->getIdUser() . '">' . $user_array[$i]->getIdUser() . " (" . $user_array[$i]->getUser_name() . ")";
            if ($user_array[$i]->getAdmin()== 1) {$output = $output . " - ADMINISTRATOR ";}
            $output=$output . "</option> <br>";   
}
echo $output;
?>
