<h1 class="page_title"> [MANAGE USERS PAGE] </h1> 
<h3> WEBSITE USER LIST </h3>
<div>
<?php include("User_list.php");
 if (isset($_SESSION['outcome'])) {
    if ($_SESSION['outcome'] == 1) {
        echo '<h3 class="error_message"> Operation reported an error: New User was not registered </h3>';
    }
    if ($_SESSION['outcome'] == 2) {
        echo '<h3 class="error_message"> Operation reported an error: User ID not found, could not update a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 3) {
        echo '<h3 class="error_message"> Operation reported an error: User ID not found, could not delete a non existent record </h3>';
    }
    if ($_SESSION['outcome'] == 4) {
        echo '<h3 class="error_message"> Operation reported an error: There is already a user with such login </h3>';
    }
    $_SESSION['outcome']=0;
}
?>
</div>
<h3 class="paragraph_title"> INSERT NEW USER </h3>
<div>
 <form class="user_data_form" action="index.php?category=administrator&page=Manage_Users.php" method="POST">
     <input type="text" name="new_user_name"  class="input_text" placeholder="Enter new username" required> <br/>
     <input type="text" name="new_user_login"  class="input_text" placeholder="Enter new user login" required> <br/>
     <input type="email" name="new_user_mail"  class="input_text" placeholder="example@something.com" required> <br/>
     <input type="password" name="new_user_password"  class="input_text" placeholder="Enter new user password" required> <br/>     
     <input type="submit" value="Create New User" name="new_user"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> UPDATE USER </h3>
<div>
 <form class="user_data_form" action="index.php?category=administrator&page=Manage_Users.php" method="POST">
     <input type="number" name="updated_id"  class="input_text" placeholder="Enter username ID" required> <br/>
     <input type="text" name="updated_user_name"  class="input_text" placeholder="Enter updated username" required> <br/>
     <input type="text" name="updated_user_login"  class="input_text" placeholder="Enter updated login" required> <br/>
     <input type="email" name="updated_user_mail"  class="input_text" placeholder="example@something.com" required> <br/>
     <input type="password" name="updated_user_password"  class="input_text" placeholder="Enter updated passsword" required> <br/>     
     <input type="submit" value="Update User" name="update_user"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> DELETE USER </h3>
<div>
 <form class="user_data_form" action="index.php?category=administrator&page=Manage_Users.php" method="POST">
     <input type="number" name="delete_user_id"  class="input_text" placeholder="Enter delete username ID" required> <br/>  
     <input  type="submit" value="Delete User" name="delete_user"> <br/>
 </form>
</div>
<h3 class="paragraph_title"> CREATE ADMINISTRATOR </h3>
<div>
 <form class="user_data_form" action="index.php?category=administrator&page=Manage_Users.php" method="POST">
     <input type="text" name="admin_name"  class="input_text" placeholder="Enter new username" required> <br/>
     <input type="text" name="admin_login"  class="input_text" placeholder="Enter new user login" required> <br/>
     <input type="email" name="admin_mail"  class="input_text" placeholder="example@something.com" required> <br/>
     <input type="password" name="admin_password"  class="input_text" placeholder="Enter new user password" required> <br/>     
     <input type="submit" value="Create New Administrator" name="new_admin"> <br/>
 </form>
</div>



