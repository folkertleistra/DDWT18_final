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

                    <!-- White wrapper box -->
                    <div class="wrapper-box">
                        <div class="login-box">

                            <!-- Top section -->
                            <div class="apr-logo">
                                <img src="../resources/logo/apartrent-logo-square.png">
                            </div>
                            <div class="upper-text">
                                <h2 class="heading">Sign In</h2>
                                <div class="alt-option-div">
                                    <a href="/DDWT18_final/register/"> Register Now </a>
                                </div>
                            </div>

                            <!-- Form -->
                            <form action="/DDWT18_final/login/" method="POST" class="sign-in-register-form">
                                <div class="form-row">
                                    <label for="username"  class="sign-in-register-label" >Username</label>
                                    <input type="text" name="username" placeholder="Enter Username" class="form-input" required>
                                </div>
                                <div class="form-row">
                                    <label for="password" class="sign-in-register-label" >Password</label>
                                    <input type="password" name="password" placeholder="Enter Password" class="form-input" required>
                                </div>
                                <div class="form-row">
                                    <button type="submit" id="form-btn">Sign In</button>
                                </div>
                            </form>

                            <!-- Return home link -->
                            <a href="/DDWT18_final/" class="return-home"> Return to the Homepage</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?= $imported_scripts ?>
    </body>
</html>