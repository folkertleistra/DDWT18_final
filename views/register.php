<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>

        <link rel="stylesheet" href="/DDWT18_final/css/login-register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title><?= $page_title ?></title>
    </head>
    <body>


    <!-- Content -->
    <form action="/DDWT18_final/register/" method="POST" class="container">
        <div class="row justify-content-center register-row">

            <!-- Wrapper column -->
            <div class="col-lg-10 wrapper-col">
                <div class="row justify-content-center">

                    <!-- Top column (contains logo / register/ sign in/ -->
                    <div class="col-lg-12 top-col">
                        <h2 class="heading">Register Now</h2>
                        <div class="apr-logo">
                            <img src="../resources/logo/apartrent-logo-square.png">
                        </div>
                        <div class="alt-option-div">
                            <a href="/DDWT18_final/login/"> Sign In </a>
                        </div>
                    </div>

                    <!-- Left column lg/md, top column sm/xs -->
                    <div class="col-lg-6 register-col">

                        <!-- Account Type -->
                        <h3 class="section-heading">Account Type</h3>

                        <div class="checkbox-section">
                            <!-- Box 1 -->
                            <div class="inputGroup">
                                <input id="radio1" name="radio" type="radio" value="owner"/>
                                <label for="radio1">Owner</label>
                            </div>

                            <!-- Box 2 -->
                            <div class="inputGroup">
                                <input id="radio2" name="radio" type="radio" value="tenant"/>
                                <label for="radio2">Tenant</label>
                            </div>
                        </div>

                        <!-- Account Details -->
                        <h3 class="section-heading">Account Details</h3>
                        <div class="form-row">
                            <label for="username"  class="sign-in-register-label">Username</label>
                            <input type="text" name="username" placeholder="Enter username" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="password"  class="sign-in-register-label">Password</label>
                            <input type="password" name="password" placeholder="Enter password" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="rt-password"  class="sign-in-register-label">Confirm password </label>
                            <input type="password" name="rt-password" placeholder="Enter password" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="email"  class="sign-in-register-label">E-mail</label>
                            <input type="email" name="email" placeholder="mail@mail.com" class="form-input" required>
                        </div>

                    </div>

                    <!-- Right column lg/md, bottom column sm/xs -->
                    <div class="col-lg-6 register-col">
                        <!-- Personal details -->
                        <h3 class="section-heading">Personal Details</h3>
                        <div class="form-row">
                            <label for="firstname"  class="sign-in-register-label">First Name</label>
                            <input type="text" name="firstname" placeholder="First Name" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="lastname" class="sign-in-register-label">Last Name</label>
                            <input type="text" name="lastname" placeholder="Last Name" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="birthdate" class="sign-in-register-label">Date of Birth</label>
                            <input type="date" name="birthdate"  class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="phone" class="sign-in-register-label">Phone Number</label>
                            <input type="tel" name="phone" placeholder="0612345678" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="language"  class="sign-in-register-label">Language</label>
                            <input type="text" name="language" placeholder="Language" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <label for="occupation"  class="sign-in-register-label">Occupation</label>
                            <input type="text" name="occupation" placeholder="Occupation" class="form-input" required>
                        </div>
                    </div>

                    <!-- Bottom column -->
                    <div class="col-lg-12 bot-col">
                        <h3 class="section-heading">Biography</h3>
                        <div class="form-row">
                            <textarea class="form-input" placeholder="Tell us a bit more about yourself!" name="biography" required></textarea>
                        </div>

                        <!-- Register / return to home -->
                        <div class="form-row">
                            <button type="submit" id="form-btn">Register</button>
                        </div>
                        <a href="/DDWT18_final/" class="return-home"> Return to the Homepage</a>
                    </div>

                </div>
            </div>
        </div>
    </form>



    <?= $imported_scripts ?>
    </body>
</html>