<?php 
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: There can be only one contribution of each artist to each event </h3>';
    }
    else if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket ID not found, could not update a non existent record </h3>';
    }
    else if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket ID not found, could not delete a non existent record </h3>';
    } 
    else if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket for this person has already been registered </h3>';
    }
    else if ($_SESSION['outcome'] == 5) {
        echo '<h3 class="error_message"> Operation reported an error: Sorry, there are no more ticket available </h3>';
    }
    else {   
    include ("Taken_places.php"); 
    include('Ticket_info.php');
    }
    $_SESSION['outcome']=0;
}
?>
