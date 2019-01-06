
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
                <?php
                    /* All rooms in the database */
                    $rooms = get_rooms($db);

                    /* Check if rooms were found */
                    if (count($rooms) == 0) {
                        $feedback = [
                            'type' => 'danger',
                            'message' => sprintf('No available rooms.')
                        ];
                        /* Print error message */
                        echo(get_error(json_encode($feedback)));
                    }

                    /* Get individual rooms from database */
                    foreach ($rooms as $room) {
                        /* Print room HTML */
                        echo(get_room_html($room));
                    }
                ?>
            </div>
        </div>


        <!-- Footer -->
        <?= $footer ?>
        <!-- Error message -->
        <div class="error-fade"><?php if (isset($error_msg)){echo $error_msg;} ?></div>
        <?= $imported_scripts ?>
    </body>
</html>