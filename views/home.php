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

        <!-- Footer -->
        <footer class="page-footer font-small">
            <div class="footer-img-wrapper">
                <img src="/DDWT18_final/resources/apartrent-logo.png" class="navbar-logo" alt="">
            </div>
            <div class="footer-copyright text-center py-3">© <?php echo date("Y") ?> Copyright - ApartRent</div>
        </footer>


        <?= $imported_scripts ?>
    </body>
</html>