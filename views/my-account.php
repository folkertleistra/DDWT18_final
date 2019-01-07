<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/account.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->
        <div class="jumbotron jumbotron-fluid myaccount-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4">ApartRent</h1>
                    <h2 class="display-6">My Account</h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-between main-row">
                <!--- Left Content --->
                <div class="col-lg-3 col-md-12 personal-col-wrapper">
                    <div class="personal-column">
                        <h3 class="name capitalize"><?= $user_info['firstname'] . ' ' . $user_info['lastname']?></h3>
                        <hr>

                        <!-- Personal information -->
                        <div>
                            <i class="fas fa-flag"></i>
                            <p class="personal-text capitalize"><?= $user_info['language']  ?></p>
                        </div>

                        <div>
                            <i class="fas fa-birthday-cake"></i>
                            <p class="personal-text"><?= $user_info['birthdate']  ?></p>
                        </div>

                        <div>
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p class="personal-text"><?= $user_info['occupation']  ?></p>
                        </div>

                        <div>
                            <i class="fas fa-envelope"></i>
                            <p class="personal-text"><?= $user_info['email']  ?></p>
                        </div>

                        <div>
                            <i class="fas fa-phone"></i>
                            <p class="personal-text"><?= $user_info['phone']  ?></p>
                        </div>

                        <hr>

                        <!-- Biography -->
                        <h4 class="bio">Biography</h4>
                        <p class="personal-text bio"><?= $user_info['biography']  ?></p>
                        <hr>

                        <!-- Edit profile button -->
                        <div class="edit-btn-wrapper">
                            <a href="/DDWT18_final/edit-account/" role="button" class="btn edit-btn">Edit account</a>
                        </div>
                    </div>
                </div>

                <!--- Right Content --->

                <div class="col-lg-8 col-md-12 info-column">
                    <!-- If role is tenant -->
                    <?php
                    if (is_tenant($db, $user_id)) {
                        echo '
                              <h3 class="optin">Requested rooms</h3>
                              <hr>';
                        /* Print HTML */
                        get_optin_html($db, $user_id);
                    }
                    else {
                        echo '
                          <h3 class="optin">My rooms</h3>
                          <hr>';
                        /* Print HTML */
                        get_optin_html($db, $user_id);
                    }
                    ?>
                </div>
            </div>
        </div>



        <!-- Footer -->
        <?= $footer ?>

        <!-- Error message -->
        <div class="error-fade"><?php if (isset($error_msg)){echo $error_msg;} ?></div>

        <?= $imported_scripts ?>
    </body>
</html>