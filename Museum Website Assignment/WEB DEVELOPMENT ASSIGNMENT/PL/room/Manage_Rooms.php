<h1 class="page_title"> [MANAGE ROOMS PAGE] </h1> 
<h3 class="paragraph_title"> ROOM LIST </h3>
<div>
<?php include("Room_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Room Name must be unique </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Room ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Room ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Room with such name has already been created </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW ROOM </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=room&page=Manage_Rooms.php" method="POST">
     <input type="number" name="new_room_floor"  class="input_text" placeholder="Enter new room floor" required> <br/>
     <input type="number" name="new_room_number"  class="input_text" placeholder="Enter new room number" required> <br/>
     <input type="text" name="new_room_name"  class="input_text" placeholder="Enter new room name" required> <br/>
     <input type="text" name="new_room_description"  class="input_text" placeholder="Enter new room description" > <br/>
     <select name="new_room_museum_id">
      <?php include("browse_museums.php"); ?>
     </select> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Create New Room" name="create_room"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE ROOM </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=room&page=Manage_Rooms.php" method="POST">
     <input type="number" name="update_room_id"  class="input_text" placeholder="Enter updated room ID" required> <br/>
     <input type="number" name="update_room_floor"  class="input_text" placeholder="Enter update room floor" required> <br/>
     <input type="number" name="update_room_number"  class="input_text" placeholder="Enter update room number" required> <br/>
     <input type="text" name="update_room_name"  class="input_text" placeholder="Enter update room name" required> <br/>
     <input type="text" name="update_room_description"  class="input_text" placeholder="Enter update room description" > <br/>
     <select name="update_room_museum_id">
      <?php include("browse_museums.php"); ?>
     </select> <br/>     
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Update Room" name="update_room"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE ROOM </h3>
<div>
 <form class="user_data_form" action="index.php?category=room&page=Manage_Rooms.php" method="POST">
     <input type="number" name="delete_room_id"  class="input_text" placeholder="Enter delete room ID" required> <br/>  
     <input type="submit" value="Delete Room" name="delete_room"> <br/>
 </form>
</div>



