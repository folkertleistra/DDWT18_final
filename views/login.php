<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/login.css">
        <title><?= $page_title ?></title>
    </head>
    <body>


        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">
                    <div class="main-logo">
                        <div class="login-box">

                            <div class="apr-logo">
                                <img src="../resources/logo/apartrent-logo-square.png">
                            </div>

                            <div class="heading">
                                <h4>Sign In</h4>
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
                                <div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>



        <?= $imported_scripts ?>
    </body>
</html>