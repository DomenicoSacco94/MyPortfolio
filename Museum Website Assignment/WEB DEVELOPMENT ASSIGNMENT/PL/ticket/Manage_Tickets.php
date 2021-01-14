<h1 class="page_title"> [MANAGE TICKETS PAGE] </h1> 
<h3 class="paragraph_title"> TICKET LIST </h3>
<div>
<?php include("Ticket_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: There can be only one contribution of each artist to each event </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Ticket for this person has already been registered </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW TICKET </h3>
<div>
 <form class="user_data_form" action="index.php?category=ticket&page=Manage_Tickets.php" method="POST">
    Ticket type: 
      <select name="new_ticket_type">
         <option value="normal">Normal</option>
         <option value="student">Student</option>
         <option value="reduced">Reduced</option>
      </select>
     <input type="text" name="new_ticketperson_name" class="input_text" placeholder="Enter new ticket person name" required> <br/>
      <select name="new_ticketevent_id">
      <?php include("browse_events.php"); ?>
      </select> <br/>
      <select name="new_ticketbuyer_id">
      <?php include("browse_users.php"); ?>
      </select> <br/>
     <input type="datetime" name="new_ticketpurchase_date" class="input_text" placeholder="Enter new ticket putchase date (yyyy-mm-dd hh:mm)" required> <br/>
     <input type="date" name="new_ticketvalidity_date" class="input_text" placeholder="Enter new ticket validy date (yyyy-mm-dd hh:mm)" required> <br/>
     <input type="number" name="new_ticket_price" class="input_text" placeholder="Enter new ticket price" required> <br/>
    <input type="submit" value="Create Ticket" name="create_ticket"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE TICKET </h3>
<div>
 <form class="user_data_form" action="index.php?category=ticket&page=Manage_Tickets.php" method="POST">
    <input type="number" name="update_ticket_id" class="input_text" placeholder="Enter update ticket ID" required> <br/>
     Ticket type: 
      <select name="update_ticket_type">
         <option value="normal">Normal</option>
         <option value="student">Student</option>
         <option value="reduced">Reduced</option>
      </select>
     <input type="text" name="update_ticketperson_name" class="input_text" placeholder="Enter update ticket person name" required> <br/>
      <select name="update_ticketevent_id">
      <?php include("browse_events.php"); ?>
      </select> <br/>
      <select name="update_ticketbuyer_id">
      <?php include("browse_users.php"); ?>
      </select> <br/>
     <input type="submit" value="Update Ticket" name="update_ticket"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE TICKET </h3>
<div>
 <form class="user_data_form" action="index.php?category=ticket&page=Manage_Tickets.php" method="POST">
     <input type="number" name="delete_ticket_id"  class="input_text" placeholder="Enter delete ticket ID" required> <br/>  
     <input type="submit" value="Delete Ticket" name="delete_ticket"> <br/>
 </form>
</div>



