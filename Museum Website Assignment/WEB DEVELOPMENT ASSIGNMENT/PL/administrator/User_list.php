<?php
$user_array=AdministratorController::retrieve_users();
$output='<table class="user_table"> <tr> <th> User ID </th> <th> User Login </th> <th> User Name </th> <th> User Mail </th> <th> User Password </th> <th> User Type </th> </tr>';
for ($i=0;$i<count($user_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $user_array[$i]->getIdUser() . '</td>';
            $output = $output . '<td>' . $user_array[$i]->getLogin() . '</td>';
            $output = $output . '<td>' . $user_array[$i]->getUser_name()  . '</td>';
            $output = $output . '<td>' . $user_array[$i]->getMail()  . '</td>';
            $output = $output . '<td>' . $user_array[$i]->getPassword()  . '</td>';
            if ($user_array[$i]->getAdmin()== 1) {$output = $output . '<td>' . "ADMINISTRATOR" . '</td>';}
            else {$output = $output . '<td>' . "REGULAR USER" . '</td>';}
            $output = $output . '</tr>';    
}
$output= $output . "</table>";
echo $output;
?>
