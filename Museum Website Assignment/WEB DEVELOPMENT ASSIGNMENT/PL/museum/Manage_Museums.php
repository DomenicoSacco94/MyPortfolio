<h1 class="page_title"> [MANAGE MUSEUMS PAGE] </h1> 
<h3 class="paragraph_title"> MUSEUM LIST </h3>
<div>
<?php include("Museum_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Museum name must be unique </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Museum ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Museum ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Museums with such name has already been registered </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW MUSEUM </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=museum&page=Manage_Museums.php" method="POST">
     <input type="text" name="new_museum_name" class="input_text" placeholder="Enter new museum name" required> <br/>
     <input type="text" name="new_museum_address" class="input_text" placeholder="Enter new museum address" > <br/>
     <input type="tel" name="new_museum_telephone" class="input_text" placeholder="Enter new museum telephone number" > <br/>
     <input type="email" name="new_museum_mail" class="input_text" placeholder="Enter new museum email" > <br/>
     <input type="text" name="new_museum_info" class="input_text" placeholder="Enter new museum description" > <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />   
     <input type="submit" value="Create New Museum" name="create_museum"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE MUSEUM </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=museum&page=Manage_Museums.php" method="POST">
     <input type="number" name="updated_museum_id" class="input_text" placeholder="Enter updated museum ID" required> <br/>
     <input type="text" name="updated_museum_name" class="input_text" placeholder="Enter updated museum name" > <br/>
     <input type="text" name="updated_museum_address" class="input_text" placeholder="Enter updated museum address" > <br/>
     <input type="tel" name="updated_museum_telephone" class="input_text" placeholder="Enter updated museum telephone number" > <br/>
     <input type="email" name="updated_museum_mail" class="input_text" placeholder="Enter updated museum email" > <br/>
     <input type="text" name="updated_museum_info" class="input_text" placeholder="Enter updated museum description" > <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />   
     <input type="submit" value="Update Museum" name="update_museum"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE MUSEUM </h3>
<div>
 <form class="user_data_form" action="index.php?category=museum&page=Manage_Museums.php" method="POST">
     <input type="number" name="delete_museum_id"  class="input_text" placeholder="Enter delete museum ID" required> <br/>  
     <input type="submit" value="Delete Museum" name="delete_museum"> <br/>
 </form>
</div>



