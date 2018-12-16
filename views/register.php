<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>
        <link rel="stylesheet" href="/DDWT18_final/css/login-register.css">
        <title><?= $page_title ?></title>
    </head>
    <body>


    <!-- Content -->
    <div class="container">
        <div class="row justify-content-center">

            <div class="col">
                <div class="form-box">
                    <div class="login-register-box">

                        <div class="apr-logo">
                            <img src="../resources/logo/apartrent-logo-square.png">
                        </div>

                        <div class="heading">
                            <h4>Register Now</h4>
                            <div class="alt-option-div">
                                <a href="/DDWT18_final/login/"> Sign In </a>
                            </div>
                        </div>
                        <form class="sign-in-register-form">
                            <div class="form-section">
                                <p>Role</p>
                                <div class="form-row">
                                    <div class="checkbox-owner">
                                        <label for="Role">Owner</label>
                                        <input type="radio" value="owner" name="role" required>
                                    </div>
                                    <div class="checkbox-tenant">
                                        <label for="role">Tenant</label>
                                        <input type="radio" value="tenant" name="role" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-section">
                                <p>Account Details</p>
                                <div class="form-row">
                                    <label for="username"  class="sign-in-register-label" >Username</label>
                                    <input type="text" name="username" placeholder="Username" class="form-input" required>
                                </div>
                                <div class="form-row">
                                    <label for="password"  class="sign-in-register-label" >Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-input" required>
                                </div>
                                <div class="form-row">
                                    <label for="email"  class="sign-in-register-label" >E-mail</label>
                                    <input type="email" name="email" placeholder="name@mail.com" class="form-input" required>
                                </div>
                                <div class="form-section">
                                    <p>Personal Details</p>
                                    <div class="form-row">
                                        <label for="firstname"  class="sign-in-register-label" >First Name</label>
                                        <input type="text" name="firstname" placeholder="First Name" class="form-input" required>
                                    </div>
                                    <div class="form-row">
                                        <label for="lastname" class="sign-in-register-label" >Last Name</label>
                                        <input type="text" name="lastname" placeholder="Last Name" class="form-input" required>
                                    </div>
                                    <div class="form-row">
                                        <label for="birthdate" class="sign-in-register-label" >Date of Birth</label>
                                        <input type="date" name="birthdate"  class="form-input" required>
                                    </div>
                                    <div class="form-row">
                                        <label for="phone" class="sign-in-register-label" >Phone Number</label>
                                        <input type="number" name="phone" placeholder="0612345678" class="form-input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" id="sign-in-btn">Sign In</button>
                            </div>
                            <a href="/DDWT18_final/"> Return to the Homepage</a>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>



    <?= $imported_scripts ?>
    </body>
</html>