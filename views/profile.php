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
                    <h2 class="display-6">Profile of <?php echo htmlspecialchars($name) ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row main-row justify-content-center ">
                <!--- Left Content --->
                <div class="col-lg-4 col-md-12 personal-col-wrapper">
                    <!-- Display personal information -->
                    <div class="personal-column">
                        <?=$personal_info ?>
                    </div>
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