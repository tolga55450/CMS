<!-- Header -->
<?php include "includes/header.php"?>
<!-- Functions -->
<?php include "functions.php"?>


<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="sign_up.php" class="signup-image-link">Create an account</a>
                    <a href="../index.php" class="signup-image-link">Go Back</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Sign in</h2>

                    <?php
                    $success = loginBackend();
                    if($success == "T"){
                        global $users_username;
                        header('Location: users/'.$users_username.'.php');
                    }
                    elseif($success == "O"){
                        echo "<strong>Please Fill the Blanks";
                    }
                    else{
                        echo "<strong>Wrong Username/Email or Password<br>Try Again</strong>";
                    }
                    ?>

                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="users_username" id="your_name" placeholder="Your Username"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="users_password" id="your_pass" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="submit" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Footer -->
<?php include "includes/footer.php"?>