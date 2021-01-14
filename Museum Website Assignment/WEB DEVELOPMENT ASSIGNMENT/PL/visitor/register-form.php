        
         <div class="lightbox" id="register_lightbox">
            <a class="close_button" href="#"> X </a>
            <form class="window_form" action="index.php?category=visitor&page=register_completed.php" method="POST">
            <span id="first_name_desc" class="input_description"> User Name </span> <br/>
            <input id="username_box" class="input_text"  type="text" name="username" placeholder="Enter user name"  required> <br/>
            <span id="login_name_desc" class="input_description"> Login </span> <br/>
            <input id="login_box" class="input_text"  type="text" name="login" placeholder="Enter login" required> <br/>
            <span id="mail_address_field" class="input_description"> Mail address </span> <br/>
            <input type="email" name="email" id="mail_address_box" class="input_text" placeholder="prova@example.com" required> <br/>
            <span id="password_name_desc" class="input_description_same_line"> Password </span>
            <span id="confirm_name_desc" class="input_description_same_line"> Confirm Password </span> <br/>
            <span class="inlineinput">
            <input class="same_line_form"  type="password" name="password" placeholder="Password" required>
            </span>
            <span class="inlineinput">
            <input class="same_line_form" type="password" name="confirmpassword" placeholder="Confirm password" required>
            </span>
            <input id="register_sub" class="submit_button" type="submit" value="Register" name="register_submit"> <br/>
            <a id="link_register_login" class="lightbox_link" href="#login_lightbox"> Login Page </a> <br/>
            <a id="link_register_forgotpass" class="lightbox_link" href="#forgotpass_lightbox"> Forgot Your Password? </a> <br/>
            </form>
        </div>

