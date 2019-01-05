
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
            <div class="row sr-row r1">

                <div class="col-lg-7 slider-col order-lg-1 order-2">

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

                <div class="room-info-col col-lg-5 order-lg-2 order-1">
                    <h2><?php echo($room_info['street'] . ' ' . $room_info['street_number'] . $room_info['addition']) ?></h2>
                    <hr>
                    <div class="room-info-wrapper">
                        <p class="room-info">
                            <span><strong>Type:</strong><?php echo($room_info['type']) ?></span>
                            <span><strong>Size:</strong><?php echo($room_info['size']) ?> m²</span>
                            <span class="price">€ <?php echo($room_info['price']) ?></span></span>
                            <br>
                            <span><strong>Street:</strong><?php echo($room_info['street'] . ' ' . $room_info['street_number'] . $room_info['addition']) ?></span><br>
                            <span><strong>Address:</strong><?php echo($room_info['postal_code'] . ' ' . $room_info['city'])?></span>
                        </p>
                        <hr>
                    </div>
                    <div class="description">
                        <p><?php echo($room_info['description']) ?></p>
                    </div>
                </div>
            </div>

            <div class="row sr-row r2">
                <div class="col-12 opt-in-col">
                    <h3>Interested? <strong>Leave a message!</strong></h3>
                    <form action="/DDWT18_final/optin/" method="POST">
                        <input type='hidden' name='room_id' value='<?php echo "$room_id"?>'/>
                        <textarea name="message"></textarea>
                        <div class="opt-btn-wrapper">
                            <button name="opt-in" type="submit" id="opt-in-btn">Request room</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row map-row r3">
                <div class="col-12 map-col">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo ($address); ?>&output=embed"></iframe>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>

        <!-- Slider script -->
        <script type="text/javascript" src="/DDWT18_final/js/single-room.js"></script>

    </body>
</html>