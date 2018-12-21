<!doctype html>
<html lang="en">
    <head>
        <?= $head_upper_content ?>

        <link rel="stylesheet" href="/DDWT18_final/css/login-register-backup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <form action="/DDWT18_final/register/" method="POST" class="sign-in-register-form">
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
                                <!--<div class="form-section">
                                    <p>Role</p>
                                    <div class="inputGroup">
                                        <input id="radio1" name="radio" type="radio" value="owner"/>
                                        <label for="radio1">Owner</label>
                                    </div>
                                    <div class="inputGroup">
                                        <input id="radio2" name="radio" type="radio" value="tenant"/>
                                        <label for="radio2">Tenant</label>
                                    </div>
                                </div>-->
                                <section class="radio-section">
                                    <h4>Role</h4>
                                    <div>
                                        <input type="radio" id="option1"  name="radio-option" value="tenant" checked >
                                        <label for="option1">
                                            <h5>Tenant</h5>
                                            <p>Select this option for tenant</p>
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" id="option2" name="radio-option" value="owner" >
                                        <label for="option2">
                                            <h5>Owner</h5>
                                            <p>Select this option for owner.</p>
                                        </label>
                                    </div>
                                </section>

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
                                    <div class="form-row">
                                        <label for="language"  class="sign-in-register-label" >Language</label>
                                        <input type="text" name="language" placeholder="Language" class="form-input" required>
                                    </div>
                                    <div class="form-row">
                                        <label for="occupation"  class="sign-in-register-label" >Occupation</label>
                                        <input type="text" name="occupation" placeholder="Occupation" class="form-input" required>
                                    </div>
                                    <div class="form-row">
                                        <label for="biography"  class="sign-in-register-label" >Biography</label>
                                        <textarea class="form-input" placeholder="Enter something about yourself" name="biography" required></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" id="sign-in-btn">Register</button>
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