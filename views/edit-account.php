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
                <div class="col-md-3 personal-column">
                    Hier moet nog wat komen te staan
                </div>

                <!--- Right Content --->
                <div class="col-md-8 info-column">
                    <!-- Right column lg/md, bottom column sm/xs -->
                    <div class="col-lg-6 register-col">
                        <form action='/DDWT18_final/edit-personal' method="POST">
                            <div class="col-12">
                                <!-- Account Details -->
                                <h3>Account Details</h3>
                                <label for="username">Username</label>
                                <input type="text" name="username"  class="form-input" value="<?php if (isset($user_info)){echo $user_info['username'];} ?>" required>
                                <label for="new-password" >New Password</label>
                                <input type="password" name="new-password" placeholder="Enter New Password">
                                <label for="check-password" >Re-Enter New Password</label>
                                <input type="password" name="check-password" placeholder="Enter New Password">
                            </div>

                            <div class="col-12">
                                <!-- Personal details -->
                                <h3>Personal Information</h3>
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" value="<?php if (isset($user_info)){echo $user_info['firstname'];} ?>" required>
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname"  value="<?php if (isset($user_info)){echo $user_info['lastname'];} ?>" required>
                                <label for="email" >E-mail</label>
                                <input type="email" name="email"  value="<?php if (isset($user_info)){echo $user_info['email'];} ?>" required>
                                <label for="birthdate">Date of Birth</label>
                                <input type="date" name="birthdate"  class="form-input" value="<?php if (isset($user_info)){echo $user_info['birthdate'];} ?>" required>
                                <label for="phone">Phone Number</label>
                                <input type="tel" name="phone" placeholder="0612345678" class="form-input" value="<?php if (isset($user_info)){echo $user_info['phone'];} ?>" required>
                                <label for="language">Language</label>
                                <input type="text" name="language"  class="form-input" value="<?php if (isset($user_info)){echo $user_info['language'];} ?>" required>
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" value="<?php if (isset($user_info)){echo $user_info['occupation'];} ?>" required>
                                <label for="biography"></label>
                                <textarea class="form-input"  name="biography" required><?php if (isset($user_info)){echo $user_info['biography'];} ?></textarea>
                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                <!-- Save changes button -->
                                <button type="submit" id="form-btn">Save</button>

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