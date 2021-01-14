<h1 class="page_title"> [MANAGE EVENTS PAGE] </h1> 
<h3 class="paragraph_title"> EVENT LIST </h3>
<div>
<?php include("Event_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Event Name be unique </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Event ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Event ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Event with such name has already been registered </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW EVENT </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=event&page=Manage_Events.php" method="POST">
     <input type="datetime" name="new_event_startdate" class="input_text" placeholder="Enter new event start date (yyyy-mm-dd hh:mm)" required> <br/>
     <input type="datetime" name="new_event_enddate" class="input_text" placeholder="Enter new event end date(yyyy-mm-dd hh:mm)" > <br/>
     <input type="text" name="new_event_name" class="input_text" placeholder="Enter new event name" required> <br/>
     <input type="num" name="new_event_max_tickets"  class="input_text" placeholder="Enter new event maximum tickets" required> <br/>
     <input type="num" name="new_event_full_price"  class="input_text" placeholder="Enter new event full ticket price" required> <br/>
     <input type="num" name="new_event_student_price"  class="input_text" placeholder="Enter new event student ticket price" required> <br/>
     <input type="num" name="new_event_reduced_price"  class="input_text" placeholder="Enter new event reduced ticket price" required> <br/>
     <input type="text" name="new_event_info"  class="input_text" placeholder="Enter new event description" > <br/>
     <select name="new_event_museum_id">
      <?php include("browse_museums.php"); ?>
     </select> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Create New Event" name="create_event"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE EVENT </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=event&page=Manage_Events.php" method="POST">
     <input type="num" name="update_event_id"  class="input_text" placeholder="Enter updated event ID" required> <br/>
     <input type="datetime" name="update_event_startdate"  class="input_text" placeholder="Enter updated event start date (yyyy-mm-dd hh:mm)" required> <br/>
     <input type="datetime" name="update_event_enddate"  class="input_text" placeholder="Enter updated event end date (yyyy-mm-dd hh:mm)" > <br/>
     <input type="text" name="update_event_name"  class="input_text" placeholder="Enter updated event name" required> <br/>
     <input type="number" name="update_event_max_tickets"  class="input_text" placeholder="Enter updated event maximum tickets" required> <br/>
     <input type="number" name="update_event_full_price"  class="input_text" placeholder="Enter updated event full ticket price" required> <br/>
     <input type="number" name="update_event_student_price"  class="input_text" placeholder="Enter updated event student ticket price" required> <br/>
     <input type="number" name="update_event_reduced_price"  class="input_text" placeholder="Enter updated event reduced ticket price" required> <br/>
     <input type="text" name="update_event_info"  class="input_text" placeholder="Enter updated event description" > <br/>
     <select name="update_event_museum_id">
      <?php include("browse_museums.php"); ?>
     </select> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Update Event" name="update_event"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE EVENT </h3>
<div>
 <form class="user_data_form" action="index.php?category=event&page=Manage_Events.php" method="POST">
     <input type="number" name="delete_event_id"  class="input_text" placeholder="Enter delete event ID" required> <br/>  
     <input type="submit" value="Delete Event" name="delete_event"> <br/>
 </form>
</div>



