<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>

        <link rel="stylesheet" href="/DDWT18_final/css/account.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        <div class="container">
            <div class="row justify-content-between main-row">
                <!--- Left Content --->
                <div class="col-md-3 left-column">
                    Hier moet nog wat komen te staan
                </div>

                <!--- Right Content --->
                <div class="col-md-8 right-column">
                    <!-- Right column lg/md, bottom column sm/xs -->
                    <div class="col-lg-6 register-col">
                        <form action="<?= $form_action ?>" method="POST">
                            <div class="col-12">
                            <!-- Personal details -->
                                <h3>Personal Information</h3>
                                <label for="firstname"  class="sign-in-register-label">First Name</label>
                                <input type="text" name="firstname" placeholder="First Name" class="form-input" value="<?php if (isset($user_info)){echo $user_info['firstname'];} ?>" required>
                                <label for="lastname" class="sign-in-register-label">Last Name</label>
                                <input type="text" name="lastname" placeholder="Last Name" class="form-input" value="<?php if (isset($user_info)){echo $user_info['lastname'];} ?>" required>

                                <label for="email"  class="sign-in-register-label">E-mail</label>
                                <input type="email" name="email" placeholder="mail@mail.com" class="form-input" value="<?php if (isset($user_info)){echo $user_info['email'];} ?>" required>
                                <label for="birthdate" class="sign-in-register-label">Date of Birth</label>
                                <input type="date" name="birthdate"  class="form-input" value="<?php if (isset($user_info)){echo $user_info['birthdate'];} ?>" required>
                                <label for="phone" class="sign-in-register-label">Phone Number</label>
                                <input type="tel" name="phone" placeholder="0612345678" class="form-input" value="<?php if (isset($user_info)){echo $user_info['phone'];} ?>" required>
                                <label for="language"  class="sign-in-register-label">Language</label>
                                <input type="text" name="language" placeholder="Language" class="form-input" value="<?php if (isset($user_info)){echo $user_info['language'];} ?>" required>
                                <label for="occupation"  class="sign-in-register-label">Occupation</label>
                                <input type="text" name="occupation" placeholder="Occupation" class="form-input" value="<?php if (isset($user_info)){echo $user_info['occupation'];} ?>" required>
                            </div>
                            <div class="col-12">
                                <h3> Biography </h3>
                                <div class="form-row">
                                    <textarea class="form-input"  name="biography" required><?php if (isset($user_info)){echo $user_info['biography'];} ?></textarea>
                                </div>
                                <!-- Register / return to home -->
                                <div class="form-row">
                                    <button type="submit" id="form-btn"><?php $submit_button ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <!-- Bottom column -->

        <?= $imported_scripts ?>
    </body>
</html>