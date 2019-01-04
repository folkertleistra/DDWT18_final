<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <title><?= $page_title ?></title>
    </head>
    <body>
        <form action="/DDWT18_final/add/" method="POST" enctype="multipart/form-data">
            <label for="city">city</label>
            <input type="text" name="city" value="test">
            <label for="postal_code">postal code</label>
            <input type="text" name="postal_code" value="test">
            <label for="street">street</label>
            <input type="text" name="street" value="test">
            <label for="street_number">street number</label>
            <input type="text" name="street_number" value=12>
            <label for="addition">addition</label>
            <input type="text" name="addition" value="test">
            <label for="size">size</label>
            <input type="text" name="size" value=10>
            <label for="type">type</label>
            <input type="text" name="type" value="test">
            <label for="price">price</label>
            <input type="text" name="price" value=12>
            <textarea name="description" placeholder="description"></textarea>
            <label for="image">image</label>
            <input type="file" name="files[]" id="fileToUpload" multiple>
            <button type="submit">Add room</button>
        </form>
    </body>
</html>