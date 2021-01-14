<h1 class="page_title"> [MANAGE ARTISTS PAGE] </h1> 
<h3 class="paragraph_title"> ARTIST LIST </h3>
<div>
<?php include("Artist_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Artist Name must be unique, there is already another artist with the same name </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Artist ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Artist ID not found, could not delete a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Impossible to update, Artist with such name has already been registered </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW ARTIST </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=artist&page=Manage_Artists.php" method="POST">
     <input type="text" name="new_artist_name"  class="input_text" placeholder="Enter new artist name" required> <br/>
     <input type="text" name="new_artist_description"  class="input_text" placeholder="Enter new artist description" > <br/>
     <input type="date" name="new_artist_born"  class="input_text" placeholder="Enter new artist born date (yyyy-mm-dd)" > <br/>
     <input type="date" name="new_artist_death"  class="input_text" placeholder="Enter new artist death date (yyyy-mm-dd)" > <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Create New Artist" name="create_artist"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE ARTIST </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=artist&page=Manage_Artists.php" method="POST">
     <input type="number" name="updated_artist_id"  class="input_text" placeholder="Enter update artist ID" required> <br/>
     <input type="text" name="updated_artist_name"  class="input_text" placeholder="Enter new artist name" required> <br/>
     <input type="text" name="updated_artist_description"  class="input_text" placeholder="Enter new artist description" /> <br/>
     <input type="date" name="updated_artist_born"  class="input_text" placeholder="Enter new artist born date (yyyy-mm-dd)" /> <br/>
     <input type="date" name="updated_artist_death"  class="input_text" placeholder="Enter new artist death date (yyyy-mm-dd)" /> <br/>
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     Choose a file to upload: <input name="uploadedfile" type="file" /><br />
     <input type="submit" value="Update Artist" name="update_artist"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE ARTIST </h3>
<div>
 <form class="user_data_form" enctype="multipart/form-data" action="index.php?category=artist&page=Manage_Artists.php" method="POST">
     <input type="number" name="delete_artist_id"  class="input_text" placeholder="Enter delete artist ID" required> <br/>  
     <input type="submit" value="Delete Artist" name="delete_artist"> <br/>
 </form>
</div>



