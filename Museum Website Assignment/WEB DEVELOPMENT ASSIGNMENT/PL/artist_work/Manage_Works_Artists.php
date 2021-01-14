<h1 class="page_title"> [MANAGE CONTRIBUTIONS PAGE] </h1> 
<h3 class="paragraph_title"> WORKS AND ARTISTS LIST </h3>
<div>
<?php include("Works_Artists_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: There can be only one contribution for each artist to each work </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Artist contribuition not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Could not delete the record </h3>';
    }
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: This contribution already exists </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW ARTIST FOR A WORK </h3>
<div>
 <form class="user_data_form" action="index.php?category=artist_work&page=Manage_Works_Artists.php" method="POST">
     <select name="new_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
      <select name="new_work_name">
      <?php include("browse_works.php"); ?>
      </select> <br/>
     <input type="text" name="new_contribution"  class="input_text" placeholder="Enter new contribution" > <br/>
     <input type="submit" value="Create New Artist for a work" name="create_contribution"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE ARTIST FOR A WORK </h3>
<div>
 <form class="user_data_form" action="index.php?category=artist_work&page=Manage_Works_Artists.php" method="POST">
      <select name="update_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
      <select name="update_work_name">
      <?php include("browse_works.php"); ?>
      </select> <br/>
     <input type="text" name="update_contr"  class="input_text" placeholder="Enter update contribution" > <br/>  
     <input type="submit" value="Update Artist for a work" name="update_contribution"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE ARTIST FOR A WORK </h3>
<div>
 <form class="user_data_form" action="index.php?category=artist_work&page=Manage_Works_Artists.php" method="POST">
      <select name="delete_artist_name">
      <?php include("browse_artists.php"); ?>
      </select> <br/>
      <select name="delete_work_name">
      <?php include("browse_works.php"); ?>
      </select> <br/>
     <input type="submit" value="Delete Artist for a work" name="delete_contribution"> <br/>
 </form>
</div>



