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

<div>
    <form action="/DDWT18_final/optin/" method="POST">
        <input type='hidden' name='room_id' value='<?php echo '$room_id'?>'/>
        <textarea name="message"></textarea>
        <button name="opt-in" type="submit">Opt-in</button>
    </form>
</div>

<form action="/DDWT18_final/test-route/" method="POST" enctype="multipart/form-data">
    <label for="image">image</label>
    <input type="file" name="files[]" id="fileToUpload" multiple>
    <button type="submit">Add room</button>
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

<?= $imported_scripts ?>
</body>
</html>