<h1 class="page_title"> [MANAGE WORKS PAGE] </h1> 
<h3> WORK LIST </h3>
<div>
<?php 
include("Work_list.php");
    
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Work name must be unique </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Work ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Work ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Work with such name has already been created </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3> INSERT NEW WORK </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=work&page=Manage_Works.php" method="POST">
     <input type="text" name="new_work_name" class="input_text" placeholder="Enter new work name" /> <br/>
     <input type="text" name="new_work_material" class="input_text" placeholder="Enter new work material" /> <br/>
     <input type="text" name="new_work_type" class="input_text" placeholder="Enter new work type" /> <br/>
     <input type="date" name="new_work_date" class="input_text" placeholder="Enter new work date" /> <br/>
     <input type="text" name="new_work_description" class="input_text" placeholder="Enter new work description" /> <br/>
     <select name="new_work_roomID">
      <?php include("browse_rooms.php"); ?>
     </select> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Create New Work" name="create_work"> <br/>
 </form>
</div>
<h3> UPDATE WORK </h3>
<div>
<form class="user_data_form" enctype="multipart/form-data" action="index.php?category=work&page=Manage_Works.php" method="POST">
     <input type="number" name="updated_work_id" class="input_text" placeholder="Enter updated work ID" /> <br/>
     <input type="text" name="updated_work_name" class="input_text" placeholder="Enter updated work name" /> <br/>
     <input type="text" name="updated_work_material" class="input_text" placeholder="Enter updated work material" /> <br/>
     <input type="text" name="updated_work_type" class="input_text" placeholder="Enter updated work type" /> <br/>
     <input type="date" name="updated_work_date" class="input_text" placeholder="Enter updated work date" /> <br/>
     <input type="text" name="updated_work_description" class="input_text" placeholder="Enter updated work description" /> <br/>
     <select name="updated_work_roomID">
      <?php include("browse_rooms.php"); ?>
     </select> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Update Work" name="update_work"> <br/>
 </form>
</div>
<h3> DELETE WORK </h3>
<div>
 <form class="user_data_form" action="index.php?category=work&page=Manage_Works.php" method="POST">
     <input type="number" name="delete_work_id"  class="input_text" placeholder="Enter delete work ID" /> <br/>  
     <input type="submit" value="Delete Work" name="delete_work"> <br/>
 </form>
</div>



