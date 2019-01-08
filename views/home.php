<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/home.css">
        <!-- single-room.css and single-room-header.php for the featured room section -->
        <link rel="stylesheet" href="/DDWT18_final/css/single-room.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->

        <div class="jumbotron jumbotron-fluid home-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4"><?= $header_title ?></h1>
                    <h2 class="display-6"><?= $header_subtitle ?></h2>
                </div>
            </div>
        </div>

        <div class="container-fluid home-button-section">
            <div class="row justify-content-center">

                <!-- CTA buttons -->
                <div class="home-btn-col">
                    <a href="/DDWT18_final/rentable-rooms/">
                        <div class="home-btn hb-1">
                            <img src="/DDWT18_final/resources/icons/appartments-icon.png">
                            <p>All available rooms</p>
                        </div>
                    </a>
                </div>
                <div class="home-btn-col">
                    <a href="/DDWT18_final/my-account/">
                        <div class="home-btn hb-2">
                          <img src="/DDWT18_final/resources/icons/my-account-icon.png">
                          <p>My ApartRent</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Introduction text with button -->
        <div class="container-fluid intro-text-container">
            <div class="row justify-content-center intro-text-row">
                <div class="col-lg-6 col-md-8 col-sm-8 intro-text-col">
                    <h3 class="introduction-header">A room for everyone</h3>
                    <p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    <p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    <div class="intro-btn-wrapper"><?= $intro_btn ?></div>
                </div>
            </div>
        </div>

        <!-- Counter section -->
        <div class="container-fluid counter-container">
            <div class="row justify-content-center counter-row">
                <div class="col-12 counter-col">
                    <div class="row justify-content-center inner-counter-row">
                        <!-- Counter blocks -->
                        <div class="col-3 col-xs-12 counter-inner-col">
                            <i class="fas fa-home counter-icon"></i>
                            <h4 class="counter-text"><b><?= $room_amnt ?></b> listed rooms</h4>
                        </div>
                        <div class="col-3 col-xs-12 counter-inner-col">
                            <i class="fas fa-address-card counter-icon"></i>
                            <h4 class="counter-text"><b><?= $owner_amnt ?></b> owners</h4>
                        </div>
                        <div class="col-3 col-xs-12 counter-inner-col">
                            <i class="fas fa-user counter-icon"></i>
                            <h4 class="counter-text"><b><?= $tenant_amnt ?></b> tenants</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured room section -->
        <div class="container featured-room-container">
            <h3 class="featured-text">Featured room</h3>
            <div class="divider-wrapper">
                <div class="divider"></div>
            </div>
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
                    <h2><?php echo(htmlspecialchars($room_info['street'] . ' ' . $room_info['street_number'] . $room_info['addition'])) ?></h2>
                    <hr>
                    <div class="room-info-wrapper">
                        <p class="room-info">
                            <span><strong>Type:</strong><?php echo htmlspecialchars($room_info['type']) ?></span>
                            <span><strong>Size:</strong><?php echo htmlspecialchars($room_info['size']) ?> m²</span>
                            <span class="price">€ <?php echo htmlspecialchars($room_info['price']) ?></span></span>
                            <br>
                            <span><strong>Street:</strong><?php echo htmlspecialchars($room_info['street'] . ' ' . $room_info['street_number'] . $room_info['addition']) ?></span><br>
                            <span><strong>Address:</strong><?php echo htmlspecialchars($room_info['postal_code'] . ' ' . $room_info['city'])?></span>
                        </p>
                        <hr>
                    </div>

                    <div class="description">
                        <p><?php echo htmlspecialchars($room_info['description']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <!-- Error message -->
        <?php if (isset($error_msg)){echo $error_msg;} ?>

        <!-- Slider script for featured room -->
        <script type="text/javascript" src="/DDWT18_final/js/single-room.js"></script>

        <?= $imported_scripts ?>
    </body>
</html>