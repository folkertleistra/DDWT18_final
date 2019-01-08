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
                    <h1 class="display-4"><?= $header_title ?></h1>
                    <h2 class="display-6"><?= $header_subtitle ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-between main-row">
                <!--- Left Content --->
                <div class="col-lg-3 col-md-12 personal-col-wrapper">
                    <!-- Display personal information -->
                    <div class ="personal-column">
                        <?= $personal_info ?>
                        <!-- Edit profile button -->
                        <div class="edit-btn-wrapper">
                            <a href="/DDWT18_final/edit-account/" role="button" class="btn edit-btn">Edit account</a>
                            <a href="#" role="button" class="btn remove-btn" data-toggle="modal" data-target="#removeModal">Remove account</a>
                        </div>
                    </div>
                </div>

                <!-- Remove modal -->
                <div id="removeModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Remove Account</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                              <p>Are you sure you want to remove your account?</p>
                          </div>
                          <div class="modal-footer">
                              <form action="/DDWT18_final/remove-account/" method="POST">
                                  <input type="hidden" value="<?= htmlspecialchars($user_id) ?>" name="user_id">
                                  <button type="submit" class="btn remove-btn">Remove account</button>
                              </form>
                              <button type="button" class="btn" data-dismiss="modal">Close</button>
                          </div>
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