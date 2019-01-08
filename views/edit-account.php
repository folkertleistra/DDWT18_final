<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>

        <link rel="stylesheet" href="/DDWT18_final/css/edit-account.css">
        <link rel="stylesheet" href="/DDWT18_final/css/form.css">
        <title><?= $page_title ?></title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <?= $navigation ?>

        <!-- Content -->
        <div class="jumbotron jumbotron-fluid myaccount-jumbo">
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

                <div class="col-lg-4 edit-col single-col">
                    <form action='/DDWT18_final/edit-account/' method="POST">

                        <!-- Personal details -->
                        <h3>Personal Information</h3>
                        <div class="form-row">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['firstname']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname"  value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['lastname']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="email" >E-mail</label>
                            <input type="email" name="email"  value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['email']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="birthdate">Date of Birth</label>
                            <input type="date" name="birthdate"  class="form-input" value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['birthdate']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" placeholder="0612345678" class="form-input" value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['phone']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="language">Language</label>
                            <input type="text" name="language"  class="form-input" value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['language']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="occupation">Occupation</label>
                            <input type="text" name="occupation" value="<?php if (isset($user_info)){echo htmlspecialchars($user_info['occupation']);} ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="biography">Biography</label>
                            <textarea class="form-input"  name="biography" required><?php if (isset($user_info)){echo htmlspecialchars($user_info['biography']);} ?></textarea>
                        </div>

                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

                        <!-- Change password -->
                        <h3>Change password</h3>

                        <div class="form-row">
                            <label for="old-password">Old password</label>
                            <input type="password" name="old-password">
                        </div>

                        <div class="form-row">
                            <label for="password1">New password</label>
                            <input type="password" name="password1">
                        </div>

                        <div class="form-row">
                            <label for="password2">Confirm new password</label>
                            <input type="password" name="password2">
                        </div>

                        <!-- Save changes button -->
                        <div class="btn-wrapper">
                            <button type="submit" id="form-btn">Save</button>
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