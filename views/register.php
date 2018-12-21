<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>

        <link rel="stylesheet" href="/DDWT18_final/css/login-register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title><?= $page_title ?></title>
    </head>
    <body>


    <!-- Content -->
    <form action="/DDWT18_final/register/" method="POST" class="container">
        <div class="row justify-content-center register-row">

            <!-- Wrapper column -->
            <div class="col-lg-10 wrapper-col">
                <div class="row justify-content-center">

                    <!-- Top column (contains logo / register/ sign in/ -->
                    <div class="col-lg-12 top-col">
                        <h2 class="heading">Register Now</h2>
                        <div class="apr-logo">
                            <img src="../resources/logo/apartrent-logo-square.png">
                        </div>
                        <div class="alt-option-div">
                            <a href="/DDWT18_final/login/"> Sign In </a>
                        </div>
                    </div>

                    <!-- Left column lg/md, top column sm/xs -->
                    <div class="col-lg-6 register-col">

                        <!-- Account Type -->
                        <h3 class="section-heading">Account Type</h3>

                        <div class="checkbox-section">
                            <!-- Box 1 -->
                            <div class="inputGroup">
                                <input id="radio1" name="radio" type="radio" value="owner"/>
                                <label for="radio1">Owner</label>
                            </div>

                            <!-- Box 2 -->
                            <div class="inputGroup">
                                <input id="radio2" name="radio" type="radio" value="tenant"/>
                                <label for="radio2">Tenant</label>
                            </div>
                        </div>

                        <!-- Account Details -->
                        <h3 class="section-heading">Account Details</h3>

                    </div>

                    <!-- Right column lg/md, bottom column sm/xs -->
                    <div class="col-lg-6 register-col">
                        <h3 class="section-heading">Personal Details</h3>
                    </div>

                </div>
            </div>

        </div>
    </form>



    <?= $imported_scripts ?>
    </body>
</html>