<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/account.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->
        <div class="jumbotron jumbotron-fluid myaccount-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4">My Account</h1>
                    <h2 class="display-6">Lorem ipsum di amor</h2>
                </div>
            </div>
        </div>

        <?php if (is_owner($db, $_SESSION['user_id'])){echo '
            
            
        ';} elseif (is_tenant($db, $_SESSION['user_id'])){echo '
            
            
        ';} else {echo '
            <div class="alert alert-'.'danger'.'" role="alert">
                '.'Your account information was not found.'.'
            </div>
            ';}?>

        <!-- Footer -->
        <?= $footer ?>

        <!-- Error message -->
        <div class="error-fade"><?php if (isset($error_msg)){echo $error_msg;} ?></div>

        <?= $imported_scripts ?>
    </body>
</html>