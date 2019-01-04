
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

                <div class="col-lg-7 slider-col">

                    <!-- Slideshow container -->
                    <div class="slideshow-container">
                        <!-- Dynamic slider -->
                        <?php

                            $img_amnt = count($room_images);

                            foreach ($room_images as $image) {
                                echo get_slider_img_html($image);
                            }
                        ?>
                    </div>

                    <!-- Do not display slider controls when only 1 image is uploaded -->
                    <?php
                        if ($img_amnt > 1) {
                            echo get_slider_dots_html($img_amnt);
                        }
                    ?>

                </div>

                <div class="col-lg-5">
                    <h2>Straat 404A</h2>
                    <hr>
                    <div class="room-info-wrapper">
                        <p class="room-info">
                            <span><strong>Type:</strong>Studio</span>
                            <span><strong>Size:</strong>404 m²</span>
                            <span class="price">€ 202</span></span>
                            <br>
                            <span><strong>Street:</strong>Straatnaam 404</span><br>
                            <span><strong>Address:</strong>1010AB Groningen</span>
                        </p>
                        <hr>
                    </div>

                </div>

            </div>
        </div>

        <!--<iframe width="640" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo ('Visserstraat 3 Klijndijk'); ?>&output=embed"></iframe>-->

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>

        <!-- Slider script -->
        <script type="text/javascript" src="/DDWT18_final/js/single-room.js"></script>
    </body>
</html>