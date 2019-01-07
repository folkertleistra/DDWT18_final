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

                    <!-- The following section is only displayed when you are the owner of the room -->
                    <div>
                        <?php if($display_buttons) { ?>
                        <div class="edit-btn-wrapper">
                            <div>
                                <a href="/DDWT18_final/edit-room/?id=<?= htmlspecialchars($room_id) ?>" role="button" class="btn btn-edit">Edit</a>
                            </div>
                            <div>
                            <form action="/DDWT18_final/remove-room/" method="POST">
                                <input type="hidden" value="<?= htmlspecialchars($room_id) ?>" name="room_id">
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                            </div>
                        </div>

                        <?php } ?>
                    </div>

                    <!-- Message that will be displayed when not logged in -->
                    <?php if(!$login) { ?>
                        <div>
                            <p class="red">Login if you want to apply for this room.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Print opt-in box if user is a tenant -->
            <?php if($display_optin) { ?>
            <div class="row sr-row r2">
                <div class="col-12 opt-in-col">
                    <h3>Interested? <strong>Leave a message!</strong></h3>
                    <form action="/DDWT18_final/optin/" method="POST">
                        <input type='hidden' name='room_id' value='<?php echo "$room_id"?>'/>
                        <textarea name="message"></textarea>
                        <div class="opt-btn-wrapper">
                            <button name="opt-in" type="submit" id="opt-in-btn">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php }?>

            <!-- print opt-out box if user is a tenant -->
            <?php if($display_optout) { ?>
                <div class="row sr-row r2">
                    <div class="col-12 opt-in-col">
                        <h3>You have already opted in for this room</h3>
                        <form action="/DDWT18_final/optout/" method="POST">
                            <input type='hidden' name='room_id' value='<?php echo "$room_id"?>'/>
                            <input type='hidden' name='tenant_id' value='<?php echo "$user_id"?>'/>
                            <div class="opt-btn-wrapper">
                                <button name="opt-in" type="submit" id="opt-in-btn">Remove application</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php }?>

            <div class="row map-row r3">
                <div class="col-12 map-col">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo ($address); ?>&output=embed"></iframe>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <!-- Error message -->
        <?php if (isset($error_msg)){echo $error_msg;} ?>

        <?= $imported_scripts ?>

        <!-- Slider script -->
        <script type="text/javascript" src="/DDWT18_final/js/single-room.js"></script>

    </body>
</html>