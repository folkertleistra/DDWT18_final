<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/add-edit-room.css">
        <link rel="stylesheet" href="/DDWT18_final/css/form.css">
        <title><?= $page_title ?></title>
    </head>
    <body>

        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Header -->
        <div class="jumbotron jumbotron-fluid add-edit-jumbo">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1 class="display-4"><?= $header_title ?></h1>
                    <h2 class="display-6"><?= $header_subtitle ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center add-row">

                <!-- Top column (contains logo / register/ sign in/ -->
                <div class="col-lg-12 top-col">
                    <div class="apr-logo">
                        <img src="/DDWT18_final/resources/logo/apartrent-logo-square.png">
                    </div>
                </div>

                <div class="col-lg-4 single-col">
                    <form action=<?=$form_action?> method="POST" enctype="multipart/form-data">

                        <div class="form-row">
                            <label for="city">City</label>
                            <input type="text" name="city" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['city']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="postal_code">Postal code</label>
                            <input placeholder="1010AB" type="text" name="postal_code" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['postal_code']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="street">Street</label>
                            <input type="text" name="street" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['street']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="street_number">Street number</label>
                            <input type="text" name="street_number" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['street_number']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="addition">Addition</label>
                            <input type="text" name="addition" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['addition']);} ?>">
                        </div>

                        <div class="form-row">
                            <label for="size">Size (m²)</label>
                            <input type="text" name="size" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['size']);} ?>">
                        </div>

                        <div class="form-row">
                            <label for="type">Type</label>
                            <input type="text" name="type" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['type']);} ?>">
                        </div>

                        <div class="form-row">
                            <label for="price">Price (€)</label>
                            <input type="text" name="price" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['price']);} ?>">
                        </div>

                        <div class="form-row">
                            <label for="description">Description</label>
                            <textarea name="description" placeholder="A beautiful room (giraffes only)!"><?php if (isset($room_info)){echo htmlspecialchars($room_info['description']);}?></textarea>
                        </div>

                        <?php if(isset($room_id)){ ?><input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id) ?>"><?php } ?>

                        <?php if($form_action == '/DDWT18_final/add-room/') { echo
                            '<div class="upload-btn-wrapper">
                                <button class="btn">Upload image(s)</button>
                                <input type="file" name="files[]" id="fileToUpload" multiple>
                            </div>';}?>

                        <div class="btn-wrapper">
                            <button type="submit"><?= $submit_btn ?></button>
                        </div>
                    </form>
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