<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/home.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->

        <div class="jumbotron jumbotron-fluid home-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4">ApartRent</h1>
                    <h2 class="display-6">Lorem ipsum di amor</h2>
                </div>
            </div>
        </div>

        <div class="container-fluid home-button-section">
            <div class="row justify-content-center">

                <div class="home-btn-col">
                    <a href="/DDWT18_final/rentable-rooms/">
                        <div class="home-btn hb-1">
                            <img src="/DDWT18_final/resources/icons/appartments-icon.png">
                            <p>All available rooms</p>
                        </div>
                    </a>
                </div>

                <div class="home-btn-col">
                    <a href="/DDWT18_final/myaccount/">
                        <div class="home-btn hb-2">
                          <img src="/DDWT18_final/resources/icons/my-account-icon.png">
                          <p>My ApartRent</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>
    </body>
</html>