<?php 
if ($_SESSION['outcome'] == 7) {echo '<h3 class="error_message"> Password and confirm password are not matching, please retry </h3>';}
else if ($_SESSION['outcome'] == 4) {echo '<h3 class="error_message"> Invalid form, there is already another user with such login </h3>';}
else {echo '<div> REGISTRATION SUCCESSFUL, LOG IN </div>';}
?>

