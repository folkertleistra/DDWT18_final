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
                    <!-- Display personal information -->
                    <?= $personal_info ?>
                </div>

                <!--- Right Content --->

                <div class="col-lg-8 col-md-12 info-column">
                    <!-- If role is tenant -->
                    <?php
                    if (is_tenant($db, $user_id)) {
                        echo '
                              <h3 class="optin">Requested rooms</h3>
                              <hr>';
                    }
                    // If role is owner
                    else {
                        echo '
                          <h3 class="optin">My rooms</h3>
                          <hr>';
                    }

                    /* Print HTML */
                    get_optin_html($db, $user_id);

                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <!-- Error message -->
        <?php if (isset($error_msg)){echo $error_msg;} ?>

        <?= $imported_scripts ?>
    </body>
</html>