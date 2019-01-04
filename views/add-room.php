<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <title><?= $page_title ?></title>
    </head>
    <body>
        <form action="/DDWT18_final/add/" method="POST" enctype="multipart/form-data">
            <label for="city">city</label>
            <input type="text" name="city">
            <label for="postal_code">postal code</label>
            <input type="text" name="postal_code">
            <label for="street">street</label>
            <input type="text" name="street">
            <label for="street_number">street number</label>
            <input type="text" name="street_number">
            <label for="addition">addition</label>
            <input type="text" name="addition">
            <label for="size">size</label>
            <input type="text" name="size">
            <label for="type">type</label>
            <input type="text" name="type">
            <label for="price">price</label>
            <input type="text" name="price">
            <textarea name="description" placeholder="description"></textarea>
            <label for="image">image</label>
            <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
            <button type="submit">Add room</button>
        </form>
    </body>
</html>