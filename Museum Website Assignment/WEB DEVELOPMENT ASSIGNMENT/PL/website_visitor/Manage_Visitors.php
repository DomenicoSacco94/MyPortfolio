<h1 class="page_title"> [MANAGE VISITORS PAGE] </h1> 
<h3> VISITORS LIST </h3>
<div>
<?php include("Visitor_list.php");
if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: Could not create a website visitor </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: Visitor ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: Visitor ID not found, could not delete a non existent record </h3>';
    } 
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: Invalid form, one or more fields are empty </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
<h3> DELETE VISITOR </h3>
<div>
 <form class="user_data_form" action="index.php?category=website_visitor&page=Manage_Visitors.php" method="POST">
     <input type="number" name="delete_visitor_id"  class="input_text" placeholder="Enter delete visitor ID" required> <br/>  
     <input type="submit" value="Delete Visitor" name="delete_visit"> <br/>
 </form>
</div>

