<h1 class="page_title"> [MANAGE PARTICIPATIONS PAGE] </h1> 
<h3 class="paragraph_title"> EVENTS AND ARTISTS LIST </h3>
<div>
<?php include("Event_Artists_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: There can be only one contribution of each artist to each event </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Partecipation not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Could not update the record, Could not delete the record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: There is already such a participation </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW ARTIST FOR AN EVENT </h3>
<div>
 <form class="user_data_form" action="index.php?category=event_artist&page=Manage_Event_Artists.php" method="POST">
      <select name="new_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
      <select name="new_event_name">
      <?php include("browse_events.php"); ?>
      </select> <br/>
     <input type="datetime" name="new_contribution_start"  class="input_text" placeholder="Enter new participation start (yyyy-mm-dd hh:mm)" > <br/>
     <input type="datetime" name="new_contribution_end"  class="input_text" placeholder="Enter new participation end (yyyy-mm-dd hh:mm)" > <br/>
     <input type="text" name="new_participation_details"  class="input_text" placeholder="Enter new participation details" > <br/>
     <input type="submit" value="Create New Participation for the event" name="create_participation"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE ARTIST FOR AN EVENT </h3>
<div>
 <form class="user_data_form" action="index.php?category=event_artist&page=Manage_Event_Artists.php" method="POST">
      <select name="update_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
     <select name="update_event_name">
      <?php include("browse_events.php"); ?>
      </select> <br/>
     <input type="datetime" name="update_contribution_start"  class="input_text" placeholder="Enter update participation start (yyyy-mm-dd hh:mm)" > <br/>
     <input type="datetime" name="update_contribution_end"  class="input_text" placeholder="Enter update participation end (yyyy-mm-dd hh:mm)" > <br/>
     <input type="text" name="update_participation_details"  class="input_text" placeholder="Enter update participation details" > <br/>
     <input type="submit" value="Update Participation for the event" name="update_participation"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE ARTIST FOR AN EVENT </h3>
<div>
 <form class="user_data_form" action="index.php?category=event_artist&page=Manage_Event_Artists.php" method="POST">
      <select name="delete_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
      <select name="delete_event_name">
      <?php include("browse_events.php"); ?>
      </select> <br/>
     <input type="submit" value="Delete Participation for the event" name="delete_participation"> <br/>
 </form>
</div>



