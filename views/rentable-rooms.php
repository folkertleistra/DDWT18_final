
<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/rentable-rooms.css">
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
                    <h2 class="display-6">All available rooms</h2>
                </div>
            </div>
        </div>

        <div class="container rr-container">

            <div class="row rr-room-row">

                <div class="col-lg-6 rr-room-box">
                    <a href="#">
                        <div class="row rr-inner-row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-img-col">
                                <img src="/DDWT18_final/resources/rooms/1.jpg">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-info-col">
                                <h3>Straatnaam 404</h3>
                                <p>4040 XX Groningen</p>
                                <p>40 m² - Single room</p>
                                <p><b>€ 404</b></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6 rr-room-box">
                    <a href="#">
                        <div class="row rr-inner-row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-img-col">
                                <img src="/DDWT18_final/resources/rooms/2.jpeg">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-info-col">
                                <h3>Straatnaam 303</h3>
                                <p>3030 XX Groningen</p>
                                <p>30 m² - Single room</p>
                                <p><b>€ 404</b></p>
                            </div>
                        </div>
                    </a>
                </div>


            </div>

        </div>

        <?php

        /* All rooms in the database */
        $rooms = get_rooms($db);

        /* Get individual rooms from database */
        foreach ($room as $value) {
            print($room);
        }

        ?>

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>
    </body>
</html>