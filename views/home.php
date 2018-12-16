<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/home.css">';
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

                <div class="col-lg-3 col-md-4 col-sm-6 home-btn-col">
                  <div class="home-btn hb-1">
                      <img src="/DDWT18_final/resources/apartrent-logo"
                  </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 home-btn-col">
                  <div class="home-btn hb-2">
                      Test
                  </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <?= $footer ?>

        <?= $imported_scripts ?>
    </body>
</html>