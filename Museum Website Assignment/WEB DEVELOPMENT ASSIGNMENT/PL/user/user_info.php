<h1 class="page_title"> [USER HOME PAGE] </h1> 
<div>
    <table class="user_table">
<tr>
<td class=line_description> Username </td> <td> <?php echo $_SESSION['user_name']?> </td>
</tr>
<tr>
<td class=line_description> Login </td> <td> <?php echo $_SESSION['user_login']?> </td>
</tr>
<tr>
<td class=line_description> Mail </td> <td> <?php echo $_SESSION['user_mail']?> </td>
</tr>
<td class=line_description> User Description </td> <td> <?php echo $_SESSION['user_description']?> </td>
</table>