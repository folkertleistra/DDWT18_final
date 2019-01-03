
<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/single-room.css">
        <?php include '../DDWT18_final/css/single-room-header.php'; ?>
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->

        <div class="jumbotron jumbotron-fluid rr-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4">ApartRent</h1>
                    <h2 class="display-6"><?= $page_subtitle ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row sr-row">

                <div class="col-lg-7">
                    <?php print_r(get_images($room_id)) ?>
                </div>

                <div class="col-lg-5">
                    test
                </div>

            </div>
        </div>

        <!--<iframe width="640" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo ('Visserstraat 3 Klijndijk'); ?>&output=embed"></iframe>-->

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>
    </body>
</html>