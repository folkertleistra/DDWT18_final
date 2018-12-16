<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/login-register.css">
        <title><?= $page_title ?></title>
    </head>
    <body>


    <!-- Content -->
    <div class="container">
        <div class="row justify-content-center">

            <div class="col">
                <div class="form-box">
                    <div class="login-box">

                        <div class="apr-logo">
                            <img src="../resources/logo/apartrent-logo-square.png">
                        </div>

                        <div class="heading">
                            <h4>Sign In</h4>
                            <div class="register-div">
                                <a href="/DDWT18_final/register/"> Register Now </a>
                            </div>
                        </div>
                        <form class="sign-in-form">
                            <div class="form-row">
                                <label for="username"  class="sign-in-label" >Username</label>
                                <input type="text" name="password" placeholder="Enter Username" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <label for="password" class="sign-in-label" >Password</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <button type="submit" id="sign-in-btn">Sign In</button>
                            </div>
                            <a href="/DDWT18_final/"> Return to the Homepage</a>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>



    <?= $imported_scripts ?>
    </body>
</html>