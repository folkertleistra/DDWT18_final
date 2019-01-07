<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/add-edit.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>
            <div class="jumbotron jumbotron-fluid add-edit-jumbo">
                <div class="container hero-container">
                    <div class="hero-text">
                        <h1 class="display-4"><?= $page_title ?></h1>
                        <h2 class="display-6"><?= $page_subtitle ?></h2>
                    </div>
                </div>
            </div>
            <form action=<?=$form_action?> method="POST" enctype="multipart/form-data">
                <label for="city">city</label>
                <input type="text" name="city" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['city']);} ?>" required>
                <label for="postal_code">postal code</label>
                <input type="text" name="postal_code" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['postal_code']);} ?>" required>
                <label for="street">street</label>
                <input type="text" name="street" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['street']);} ?>" required>
                <label for="street_number">street number</label>
                <input type="text" name="street_number" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['street_number']);} ?>" required>
                <label for="addition">addition</label>
                <input type="text" name="addition" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['addition']);} ?>">
                <label for="size">size</label>
                <input type="text" name="size" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['size']);} ?>">
                <label for="type">type</label>
                <input type="text" name="type" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['type']);} ?>">
                <label for="price">price</label>
                <input type="text" name="price" value="<?php if (isset($room_info)){echo htmlspecialchars($room_info['price']);} ?>">
                <textarea name="description" placeholder="description"><?php if (isset($room_info)){echo htmlspecialchars($room_info['description']);}?></textarea>

                <?php if(isset($room_id)){ ?><input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id) ?>"><?php } ?>

                <?php if($form_action == '/DDWT18_final/add/') { echo
                '<label for="image">image</label><input type="file" name="files[]" id="fileToUpload" multiple>';}?>

                <button type="submit"><?= $submit_btn ?></button>
            </form>

        <!-- Error message -->
        <?php if (isset($error_msg)){echo $error_msg;} ?>
    </body>
</html>