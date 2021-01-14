        
        <div class="lightbox" id="login_lightbox">
            <a class="close_button" href="#"> X </a>
            <form class="window_form" action="index.php?category=user&page=home.php" method="POST">
            <span class="input_description"> Username </span> <br/>
            <input type="text" name="username" class="input_text" placeholder="Enter username" required> <br/>
            <span class="input_description"> Password </span> <br/>
            <input type="password" name="password" class="input_text" placeholder="Enter password" required> <br/>
            <input id="login_sub" class="submit_button" type="submit" value="Login" name="login_submit" required> <br/>
            <a id="link_login_register" class="lightbox_link" href="#register_lightbox"> Register Account </a> <br/>
            <a id="link_login_forgotpass" class="lightbox_link" href="#forgotpass_lightbox"> Forgot Your Password? </a> <br/>
            </form>
        </div>