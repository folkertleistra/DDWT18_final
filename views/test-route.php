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

<form action="/DDWT18_final/remove-room/"
      method="POST">
    <input type="hidden" value='<?php echo "$room_id"?>' name="room_id">
    <button type="submit" class="btn btn-danger">Remove</button>
</form>

<div class="container-fluid home-button-section">
    <div class="row justify-content-center">

        <div class="col-3 home-btn-col">
            <div class="home-btn">
                Test
            </div>
        </div>

        <div class="col-3 home-btn-col">
            <div class="home-btn">
                Test
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<?= $footer ?>

<!-- Error message -->
<?php if (isset($error_msg)){echo $error_msg;} ?>


<?= $imported_scripts ?>
</body>
</html>