<?php
/**
 * Model
 * User: Folkert Leistra, Thijmen Dam, Hylke van der Veen
 * Date: 28-11-2018
 * Time: 17:30
 */

/* Enable error reporting */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Connects to the database using PDO
 * @param string $host database host
 * @param string $db database name
 * @param string $user database user
 * @param string $pass database password
 * @return pdo object
 */
function connect_db($host, $db, $user, $pass) {
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        echo sprintf("Failed to connect. %s",$e->getMessage());
    }
    return $pdo;
}

/**
 * Get registration form data without passwords
 * @param $form_data
 * @return array
 */
function get_register_data($form_data) {
    $output = Array();
    foreach ($form_data as $key => $value){
        if (!($key == 'password' or $key == 'rt-password')){
            $output[$key] = $value;
        }
    }
    return $output;
}

/*
 * ------------
 * START: ROUTE
 * ------------
 */

/**
 * Check if the route exist
 * @param string $route_uri URI to be matched
 * @param string $request_type request method
 * @return bool
 *
 */
function new_route($route_uri, $request_type) {
    $route_uri_expl = array_filter(explode('/', $route_uri));
    $current_path_expl = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    if ($route_uri_expl == $current_path_expl && $_SERVER['REQUEST_METHOD'] == strtoupper($request_type)) {
        return true;
    }
}

/**
 * Changes the HTTP Header to a given location
 * @param string $location location to be redirected to
 */
function redirect($location) {
    header(sprintf('Location: %s', $location));
    die();
}

/*
 * ----------
 * END: ROUTE
 * ----------
 */


/*
 * -------------------
 * START: PAGE CONTENT
 * -------------------
 */

/**
 * Creates a new navigation array item using url and active status
 * @param string $url The url of the navigation item
 * @param bool $active Set the navigation item to active or inactive
 * @return array
 */
function na($url, $active) {
    return [$url, $active];
}

/**
 * Creates filename to the template
 * @param string $template filename of the template without extension
 * @return string
 */
function use_template($template) {
    $template_doc = sprintf("views/%s.php", $template);
    return $template_doc;
}

/**
 * Creates navigation HTML code using given array
 * @param array $navigation Array with as Key the page name and as Value the corresponding url
 * @return string html code that represents the navigation
 */
function get_navigation($template, $active_id, $state, $role) {
    $navigation_exp = '
    <nav class="navbar fixed-top navbar-expand-lg navbar-light">
    <a href="/DDWT18_final/" class="navbar-brand">
        <img src="/DDWT18_final/resources/logo/apartrent-logo.png" class="navbar-logo" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';

    foreach ($template as $name => $info) {
        if ($info['role'] == $role or $info['role'] == 'all' ) {
            if ($info['state'] == $state or $info['state'] == 'neutral'){
                /* makes the active url bold */
                if ($name == $active_id) {
                    $navigation_exp .= '<li class="nav-item active">';
                    $navigation_exp .= '<a class="nav-link" href="' . $template[$active_id]['url'] . '">' . $template[$active_id]['name'] . '</a>';
                    }
                else {
                    $navigation_exp .= '<li class="nav-item">';
                    $navigation_exp .= '<a class="nav-link" href="' . $info['url'] . '">' . $info['name'] . '</a>';
                    }
            }

        }
        $navigation_exp .= '</li>';
    }
    $navigation_exp .= '
    </ul>
    </div>
    </nav>';
    return $navigation_exp;
}

/**
 * Returns the HTML head upper content in HTML code
 * @return string
 */
function get_head_upper_content() {
    return '<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Favicon: NB: this does not work when hosting locally on MAMP -->
        <link rel="icon" 
            type="image/png" 
            href="/favicon.ico">
        
        <!-- Custom Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Vidaloka" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="/DDWT18_final/css/main.css">
        
        <!-- Custom JS -->
        <script src="/DDWT18_final/js/main.js"></script>';
}

/**
 * Returns imported scripts HTML
 * @return string
 */
function get_imported_scripts() {
    return '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>';
}

// TODO: description
/**
 * @return string
 */
function get_footer_content() {
    return '<footer class="page-footer font-small">
        <div class="footer-img-wrapper">
            <img src="/DDWT18_final/resources/logo/apartrent-logo.png" class="navbar-logo" alt="">
        </div>
        <div class="footer-copyright text-center py-3">© <?php echo date("Y") ?> Copyright - ApartRent</div>
        </footer>';
}

/*
 * -----------------
 * END: PAGE CONTENT
 * -----------------
 */


/*
 * --------------
 * START: SESSION
 * --------------
 */

/**
 * Check if a user is logged in
 * @return bool
 */
function check_login() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}

/**
 * Get current user id
 * @return bool current user id or false if not logged in
 */
function get_user_id(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_id'])){
        return $_SESSION['user_id'];
    } else {
        return false;
    }
}

/**
 * Start a session for a user
 * @param $pdo
 * @param $form_data
 * @return array
 */
function login_user($pdo, $form_data) {
    /* Check if user is already logged in */
    if ( check_login() ){
        $feedback = [
            'type' => 'warning',
            'message' => 'You are already logged in.'
        ];
        redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
    }

    /* Check if all fields are set */
    if (
        empty($form_data['username']) or
        empty($form_data['password'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'Please enter your username and password.'
        ];
    }

    /* Check if user exists */
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$form_data['username']]);
        $user_info = $stmt->fetch();
    } catch (\PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }
    /* Return error message for wrong username */
    if (empty($user_info)) {
        return [
            'type' => 'danger',
            'message' => 'The username you entered does not exist.'
        ];
    }

    /* Check password */
    if (!password_verify($form_data['password'], $user_info['password'])) {
        return [
            'type' => 'danger',
            'message' => 'The password you entered is incorrect.'
        ];
    } else {
        session_start();
        $_SESSION['user_id'] = $user_info['id'];
        $feedback = [
            'type' => 'success',
            'message' => sprintf('%s, you were logged in successfully.', get_user_firstname($pdo, $_SESSION['user_id']))
        ];
        redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
    }
}

/**
 * Logout user
 * @return array
 */
function logout_user() {
    /* Check if user is already logged out */
    if ( !check_login() ){
        $feedback = [
            'type' => 'warning',
            'message' => 'You are already logged out.'
        ];
        redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($feedback)));
    }

    session_start();
    session_unset();
    session_destroy();
    $feedback = [
        'type' => 'success',
        'message' => sprintf('You were logged out successfully.')
    ];
    return $feedback;
}

/*
 * ------------
 * END: SESSION
 * ------------
 */


/*
 * --------------------
 * START: HTML GENERATE
 * --------------------
 */


/**
 * Returns HTML of the bubtton in the intro section on the homepage, based on state
 * @param $pdo
 * @return string
 */
function get_intro_button($pdo) {
    if (check_login()) {

        $user_id = $_SESSION['user_id'];

        if (is_owner($pdo, $user_id)) {
            $intro_btn = '<a class="intro-btn" href="/DDWT18_final/add-room/">List a room</a>';
        } else {
            $intro_btn = '<a class="intro-btn" href="/DDWT18_final/rentable-rooms/">Start searching now</a>';
        }
    } else {
        $intro_btn = '<a class="intro-btn" href="/DDWT18_final/register/">Register now</a>';
    }

    return $intro_btn;
}

// TODO: description
/**
 * @param $db
 * @param $user_info
 * @return string
 */
function get_personal_info_html($db, $user_info) {

    $template ='
    <div>
        <h3 class="name">$name</h3>
        <hr>
    
        <!-- Personal information -->
        <div>
            <i class="fas fa-user"></i>
            <p class="personal-text">$username<br>$role</p>
        </div>
        
        <div>
            <i class="fas fa-flag"></i>
            <p class="personal-text capitalize">$lang</p>
        </div>
    
        <div>
            <i class="fas fa-birthday-cake"></i>
            <p class="personal-text">$birthdate</p>
        </div>
    
        <div>
            <i class="fas fa-chalkboard-teacher"></i>
            <p class="personal-text">$occupation</p>
        </div>
    
        <div>
            <i class="fas fa-envelope"></i>
            <p class="personal-text">$mail</p>
        </div>
    
        <div>
            <i class="fas fa-phone"></i>
            <p class="personal-text">$phone</p>
        </div>
        <hr>
    
        <!-- Biography -->
        <h4 class="bio">Biography</h4>
        <p class="personal-text bio">$bio</p>
        <hr>
    </div>';

    $birthdate = date("d-m-Y", strtotime($user_info['birthdate']));
    return strtr($template, array('$name' => $user_info['firstname'] . ' ' . $user_info['lastname'], '$lang' => $user_info['language'],
         '$birthdate' => $birthdate, '$occupation' => $user_info['occupation'], '$mail' => $user_info['email'],
         '$phone' => $user_info['phone'], '$bio' => $user_info['biography'], '$role' => get_role($db, $user_info['id']),
         '$username' => $user_info['username']));
}

/**
 * Create HTML alert code with information about the success or failure
 * @param bool $type true if success, false if failure
 * @param string $message Error/Success message
 * @return string
 */
function get_error($feedback) {
    $feedback = json_decode($feedback, true);
    $error_exp = '
        <div class="error-fade">
            <div class="alert alert-'.$feedback['type'].'" role="alert">
                '.$feedback['message'].'
            </div>
        </div>';
    return $error_exp;
}

/**
 * Pritty Print Array
 * @param $input
 */
function p_print($input) {
    echo '<pre>';
    print_r($input);
    echo '</pre>';
}

/**
 * Returns the right room HTML for an individual room
 * @param $room
 * @return string
 */
function get_room_html($room) {
    /* HTML template */
    $template =
        '<div class="col-lg-6 rr-room-box">
            <a href="/DDWT18_final/room/?id=$room_id">
                <div class="row rr-inner-row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-img-col">
                        <img src="$image">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rr-info-col">
                        <h3>$street $nr$add</h3>
                        <p>$postal $city</p>
                        <p>$size m² - $type</p>
                        <p><b>€ $price</b></p>
                    </div>
                </div>
            </a>
         </div>';

    /* Get thumbnail */
    $thumbnail = get_images($room['id'])[0];

    /* Add correct values to the template */
    return strtr($template, array('$street' => $room['street'], '$nr' => $room['street_number'],
        '$add' => $room['addition'], '$postal' => $room['postal_code'], '$city' => $room['city'],
        '$size' => $room['size'], '$type' => $room['type'], '$price' => $room['price'], '$image' => $thumbnail,
        '$room_id' => $room['id']));
}

/**
 * Returns the right slide HTML per image
 * @param $image
 */
function get_slider_img_html($image) {
    $template =
        '<div class="slides slider-fade">
            <img src="$img" style="width:100%">
        </div>';

    return strtr($template, array('$img' => $image));
}

/**
 * Returns the HTML of the slider dots based on the amount of images
 * @param $img_amnt
 */
function get_slider_dots_html($img_amnt) {
    $counter = 1;
    $inner_html = '';

    while ($counter <= $img_amnt) {
        $inner_html .= sprintf('<span class="dot" onclick="currentSlide(%s)"></span>', $counter);
        $counter += 1;
    }

    return '<div class="slider-controls">
                <div class="dot-wrapper">
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>'
                    . $inner_html .
                    '<a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
            </div>';
}

// TODO: description
/**
 * @param $db
 * @param $user_id
 * @return string
 */
function get_optin_html($db, $user_id) {

    /* Determine role and get optins */
    if (is_tenant($db, $user_id)) {
        $role = "tenant";
        $optins = get_tenant_optin($db, $user_id);
    } else{
        $role = "owner";
        $optins = get_owner_optin($db, $user_id);
    }

    /* If tenant with no opt-ins */
    if (count($optins) == 0 && $role == "tenant") {
        echo '<p class="no-optin">You have not yet requested any rooms.</p>';
    /* If owner with no registered rooms */
    } elseif (count(get_owned_rooms_id($db, $user_id)) == 0 && $role == "owner") {
        echo '<p class="no-optin">You have not yet registered any rooms.</p>';
    } else {

        /* HTML templates */
        $template_room_tenant = '
        
            <div class="row optin-row">
                <!-- image col -->
                <div class="col-lg-5">
                    <div class="optin-thumb-wrapper">
                        <img src="$thumbnail" class="optin-thumb">
                    </div>               
                </div>
            
                <!-- optin info col -->
                <div class="col-lg-7 optin-info-col">
                    <h4>$street $nr$add</h4>
                    <p>$postal_code $city</p>
                    <p>$size m² - $type</p>
                    <p class="price">€ $price</p>
                    <h5 class="message">Message:</h5>
                    <p class="message"><i>$message</i></p>
                    <div class="viewroom-btn-wrapper">
                        <a href="$href" class="view-room btn">View room</a>
                    </div>
                </div>
            </div>
            <hr class="bottom-hr">
        ';

        $template_room_owner = '
        
            <div class="row optin-row">
                <!-- image col -->
                <div class="col-lg-5">
                    <div class="optin-thumb-wrapper">
                        <img src="$thumbnail" class="optin-thumb">
                    </div>               
                </div>
            
                <!-- optin info col -->
                <div class="col-lg-7 optin-info-col">
                    <h4>$street $nr$add</h4>
                    <p>$postal_code $city</p>
                    <p>$size m² - $type</p>
                    <p class="price">€ $price</p>
                    <div class="viewroom-btn-wrapper">
                        <a href="$href" class="view-room btn">View room</a>
                    </div>
                </div>
            </div>
        ';

        $template_messages = '
            <h5 class="message">Request by <span class="capitalize"><a href="$profile-href">$optin-user</a></span></h5>
            <p class="message"><i>$message</i></p>
            ';

        // IF tenant
        if ($role == "tenant") {

            foreach ($optins as $key => $room_optin) {
                $room_info = get_room_info($db, $room_optin['room_id']);

                // Echo room HTML
                echo strtr($template_room_tenant, array('$city' => $room_info['city'], '$thumbnail' => get_images($room_info['id'])[0], '$street' => $room_info['street'],
                    '$nr' => $room_info['street_number'], '$add' => $room_info['addition'], '$postal_code' => $room_info['postal_code'], '$size' => $room_info['size'], '$type' => $type = $room_info['type'],
                    '$price' => $room_info['price'], '$message' => $room_optin['message'],
                    '$href' => '/DDWT18_final/room/?id=' . $room_optin['room_id']));
            }

        // IF owner
        } elseif ($role == "owner") {

            // Get all room ID's owned by the owner
            $owned_room_ids = get_owned_rooms_id($db, $user_id);

            // Get all room ID's owned by the owner that have opt-ins
            $room_ids_with_optin = check_optins($db, $owned_room_ids);
            $room_ids_without_optin = check_optins_diff($db, $owned_room_ids);


            // HTML for rooms with opt-ins
            foreach ($room_ids_with_optin as $key => $room_id) {

                // Echo room HTML
                $room_info = get_room_info($db, $room_id);
                echo strtr($template_room_owner, array('$city' => $room_info['city'], '$thumbnail' => get_images($room_info['id'])[0], '$street' => $room_info['street'],
                    '$nr' => $room_info['street_number'], '$add' => $room_info['addition'], '$postal_code' => $room_info['postal_code'], '$size' => $room_info['size'], '$type' => $type = $room_info['type'],
                    '$price' => $room_info['price'], '$href' => '/DDWT18_final/room/?id=' . $room_id));

                // Echo messages
                foreach ($optins as $key2 => $optin_info) {
                    if ($room_id == $optin_info['room_id']) {
                        $tenant_info = get_user_info($db, $optin_info['tenant_id']);
                        echo strtr($template_messages, array('$message' => $optin_info['message'],
                            '$optin-user' => $tenant_info['firstname'] . ' ' . $tenant_info['lastname'],
                            '$profile-href' => '/DDWT18_final/profile/?id=' . $optin_info['tenant_id']));
                    }
                }
                echo '<hr class="bottom-hr">';
            }

            // HTML for rooms without opt-ins
            foreach ($room_ids_without_optin as $key => $room_id) {

                // Echo room HTML
                $room_info = get_room_info($db, $room_id);
                echo strtr($template_room_owner, array('$city' => $room_info['city'], '$thumbnail' => get_images($room_info['id'])[0], '$street' => $room_info['street'],
                    '$nr' => $room_info['street_number'], '$add' => $room_info['addition'], '$postal_code' => $room_info['postal_code'], '$size' => $room_info['size'], '$type' => $type = $room_info['type'],
                    '$price' => $room_info['price'], '$href' => '/DDWT18_final/room/?id=' . $room_id));
                echo '<h5 class="message no-optin">No room requests.</h5>';
                echo '<hr class="bottom-hr">';

            }

        }
    }
}

/*
 * ------------------
 * END: HTML GENERATE
 * ------------------
 */

// TODO: description and reposition
/**
 * @param $pdo
 * @param $owned_room_ids
 * @return array
 */
function check_optins($pdo, $owned_room_ids) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT DISTINCT room_id FROM optin');
    $stmt->execute();
    $rooms = $stmt->fetchAll();

    // array with all room_id's that have opt-ins
    $room_ids = Array();

    /* Create array with htmlspecialchars */
    foreach ($rooms as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $room_ids[] = htmlspecialchars($user_input);
        }
    }

    // Owned room ID's that have opt-ins
    return array_intersect($owned_room_ids, $room_ids);
}

// TODO: description and reposition
/**
 * @param $pdo
 * @param $owned_room_ids
 * @return array
 */
function check_optins_diff($pdo, $owned_room_ids) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT DISTINCT room_id FROM optin');
    $stmt->execute();
    $rooms = $stmt->fetchAll();

    // array with all room_id's that have opt-ins
    $room_ids = Array();

    /* Create array with htmlspecialchars */
    foreach ($rooms as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $room_ids[] = htmlspecialchars($user_input);
        }
    }

    // Owned room ID's that have opt-ins
    return array_diff($owned_room_ids, $room_ids);
}

/*
 * ------------------
 * START: CARDS COUNT
 * ------------------
 */

/**
 * Returns number of owners in the database
 * @param $pdo
 * @return mixed
 */
function count_owners($pdo) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM owner');
    $stmt->execute();
    $owners = $stmt->rowCount();

    return $owners;
}

/**
 * Returns number of tenants in the database
 * @param $pdo
 * @return mixed
 */
function count_tenants($pdo) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM tenant');
    $stmt->execute();
    $tenants = $stmt->rowCount();

    return $tenants;
}

/**
 * Returns number of available rooms in the database
 * @param $pdo
 * @return mixed
 */
function count_rooms($pdo) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM rooms');
    $stmt->execute();
    $rooms = $stmt->rowCount();

    return $rooms;
}

/*
 * ----------------
 * END: CARDS COUNT
 * ----------------
 */


/*
 * ----------------------
 * START: DATABASE SELECT
 * ----------------------
 */

/**
 * Returns all info for a single user
 * @param $pdo
 * @param $user_id
 * @return array
 */
function get_user_info($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $users = $stmt->fetchAll();

    /* Return if no user was found */
    if (empty($users)){
        return;
    }
    $user = $users[0];
    $user_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($user as $key => $value){
        $user_exp[$key] = htmlspecialchars($value);
    }
    return $user_exp;
}

/**
 * Returns firstname for a single user
 * @param $pdo
 * @param $user_id
 * @return string
 */
function get_user_firstname($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT firstname FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    $firstname = htmlspecialchars($user['firstname']);
    return $firstname;
}

/**
 * Check if a user id belongs to an owner
 * @param $pdo
 * @param $user_id
 * @return bool
 */
function is_owner($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM owner WHERE owner_id = ?');
    $stmt->execute([$user_id]);
    $users = $stmt->fetchAll();
    if (count($users) == 0) {
        return false;
    }
    return true;
}

/**
 * Check if a user id belongs to a tenant
 * @param $pdo
 * @param $user_id
 * @return bool
 */
function is_tenant($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM tenant WHERE tenant_id = ?');
    $stmt->execute([$user_id]);
    $users = $stmt->fetchAll();
    if (count($users) == 0) {
        return false;
    }
    return true;
}

// TODO: description
/**
 * @param $pdo
 * @param $id
 * @return string
 */
function get_role($pdo, $id) {
    if (is_owner($pdo, $id)) {
        return 'owner';
    }
    else {
        return 'tenant';
    }
}

/**
 * Returns a random id from rooms table
 * @param $pdo
 * @return mixed
 */
function get_random_room_id($pdo) {
    $stmt = $pdo->prepare('SELECT id FROM rooms ORDER BY RAND() LIMIT 1;');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result[0]['id'];
}

/**
 * Returns all applications for a single room
 * @param $pdo
 * @param $room_id
 * @return array
 */
function get_room_optin($pdo, $room_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT tenant_id, message FROM optin WHERE room_id = ?');
    $stmt->execute([$room_id]);
    $messages = $stmt->fetchAll();
    $messages_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($messages as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $messages_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $messages_exp;
}

/**
 * Returns all room applications for a single user
 * @param $pdo
 * @param $user_id
 * @return array
 */
function get_tenant_optin($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT room_id, message FROM optin WHERE tenant_id = ?');
    $stmt->execute([$user_id]);
    $messages = $stmt->fetchAll();
    $messages_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($messages as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $messages_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $messages_exp;
}

/**
 * Returns all room applications for a single user
 * @param $pdo
 * @param $user_id
 * @return array
 */
function get_owner_optin($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT DISTINCT room_id, message, tenant_id FROM optin NATURAL JOIN rooms WHERE owner_id = ?');
    $stmt->execute([$user_id]);
    $messages = $stmt->fetchAll();
    $messages_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($messages as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $messages_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $messages_exp;
}

/**
 * Returns all information for a single room
 * @param $pdo
 * @param $room_id
 * @return array
 */
function get_room_info($pdo, $room_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $rooms = $stmt->fetchAll();

    /* Return if no room was found */
    if (empty($rooms)){
        return;
    }
    $room = $rooms[0];
    $room_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($room as $key => $value){
        $room_exp[$key] = htmlspecialchars($value);
    }
    return $room_exp;
}

// TODO: description
/**
 * @param $pdo
 * @param $room_id
 * @return string
 */
function get_room_address($pdo, $room_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT street, street_number, addition, city FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $rooms = $stmt->fetchAll();
    $room = $rooms[0];
    $room_exp = "";

    /* Create array with htmlspecialchars */
    foreach ($room as $key => $value){
        $room_exp .= ' ' . $value;
    }
    return $room_exp;
}

/**
 * Returns the information of all available rooms
 * @param $pdo
 * @return array
 */
function get_rooms($pdo) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM rooms');
    $stmt->execute();
    $rooms = $stmt->fetchAll();
    $rooms_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($rooms as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $rooms_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $rooms_exp;
}

/**
 * Retrieve all rooms owned by a user, and their info
 * @param $pdo
 * @param $owner_id
 * @return array
 */
function get_owned_rooms($pdo, $owner_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_id = ?');
    $stmt->execute([$owner_id]);
    $rooms = $stmt->fetchAll();
    $rooms_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($rooms as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $rooms_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $rooms_exp;
}
/**
 * Retrieve the ID's of the rooms owned by the owner
 * @param $pdo
 * @param $owner_id
 * @return array
 */
function get_owned_rooms_id($pdo, $owner_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT id FROM rooms WHERE owner_id = ?');
    $stmt->execute([$owner_id]);
    $rooms = $stmt->fetchAll();
    $room_ids = Array();

    /* Create array with htmlspecialchars */
    foreach ($rooms as $key => $value){
        foreach ($value as $user_key => $user_input) {
            $room_ids[] = htmlspecialchars($user_input);
        }
    }
    return $room_ids;
}
/**
 * Returns array with all image urls for given room id
 * @param $room_id
 * @return array|false
 */
function get_images($room_id) {
    /* Get all image urls */
    $dir = "resources/rooms/" . strval($room_id);
    $files = glob($dir . "/*.{jpg,png}", GLOB_BRACE);
    $images = Array();
    foreach ($files as $key => $value){
        $trimmed = '/DDWT18_final/' . $value;
        $images[$key] = $trimmed;
    }
    return $images;
}

/**
 * This function retrieves the opt-in message for a given room and user
 * @param $pdo
 * @param $room_id int
 * @param $user_id int
 * @return mixed string
 */
function get_optin_message($pdo, $room_id, $user_id) {
    $stmt = $pdo->prepare('SELECT message FROM optin WHERE tenant_id = ? AND room_id = ?');
    $stmt->execute([$user_id, $room_id]);
    $message_array = $stmt->fetchAll();
    return $message_array[0]['message'];
}
/**
 * This function checks whether or not a user is already opted in to a room.
 * @param $pdo
 * @param $room_id
 * @param $user_id
 * @return bool
 */
function opted_in($pdo, $room_id, $user_id) {
    $stmt = $pdo->prepare('SELECT tenant_id FROM optin WHERE room_id = ?');
    $stmt->execute([$room_id]);
    $tenant_arrray = $stmt->fetchAll();

    $tenant_array = array();
    foreach ($tenant_arrray as $key=>$value) {
        array_push($tenant_array, $value['tenant_id']);
    }
    if (in_array($user_id, $tenant_array)) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function checks if the currently logged in user is also the owner of the current room
 * @param $pdo
 * @param $room_id int
 * @param $user_id int
 * @return bool
 */
function owns_room($pdo, $room_id, $user_id) {
    /* Select the id of the owner of the room from the database */
    $stmt = $pdo->prepare('SELECT owner_id FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $original_owner_array = $stmt->fetchAll();
    $original_owner = $original_owner_array[0]['owner_id'];

    if ($user_id === $original_owner) {
        return true;
    }
    else {
        return false;
    }
}


/*
 * --------------------
 * END: DATABASE SELECT
 * --------------------
 */


/*
 * ----------------------
 * START: DATABASE INSERT
 * ----------------------
 */

/**
 * Adds a new user to the database and logs them in
 * @param $pdo
 * @param $form_data
 * @return array
 */
function register_user($pdo, $form_data) {
    /* Check if all fields are set */
    if (
        empty($form_data['radio']) or
        empty($form_data['firstname']) or
        empty($form_data['lastname']) or
        empty($form_data['username']) or
        empty($form_data['password']) or
        empty($form_data['rt-password']) or
        empty($form_data['email']) or
        empty($form_data['phone']) or
        empty($form_data['birthdate']) or
        empty($form_data['language']) or
        empty($form_data['biography']) or
        empty($form_data['occupation'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'Please fill in all required fields.'
        ];
    }

    /* Check data type for the phone field */
    if (!is_numeric($form_data['phone'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Phone Number\' field.'
        ];
    }
    /* check if phone number consists of 10 digits. */
    $amount = strlen($form_data['phone']);
    $max = 10;
    if (!($amount === $max)) {
        return [
            'type' => 'danger',
            'message' => 'Please enter a phone number that consists of 10 digits.'
        ];
    }

    if ($form_data['password'] !== $form_data['rt-password']) {
        return [
            'type' => 'danger',
            'message' => 'The entered passwords do not match.'
        ];
    }

    /* Check if user already exists */
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$form_data['username'], $form_data['email']]);
        $user_exists = $stmt->rowCount();
    } catch (\PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Return error message for existing user */
    if ( !empty($user_exists) ) {
        return [
            'type' => 'danger',
            'message' => 'The username or e-mail address you entered already exists.'
        ];
    }

    /* Hash password */
    $password = password_hash($form_data['password'], PASSWORD_DEFAULT);;

    /* Set date to proper form */
    $birthdate = date("Y-m-d", strtotime($form_data['birthdate']));

    /* Check if role has been set */
    if (!($form_data['radio'] == 'owner' or $form_data['radio'] == 'tenant')) {
        return [
            'type' => 'danger',
            'message' => sprintf('No correct role was found.')
        ];
    }

    /* Save user to the database */
    try {
        $stmt = $pdo->prepare('INSERT INTO users (username, password, firstname, lastname, email, phone, birthdate, language, 
                               occupation, biography) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$form_data['username'], $password, $form_data['firstname'], $form_data['lastname'], $form_data['email'],
            $form_data['phone'], $birthdate, $form_data['language'], $form_data['occupation'], $form_data['biography']]);
        $user_id = $pdo->lastInsertId();
    } catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Add user id to correct group (owner/tenant) */
    if ($form_data['radio'] == 'owner') {
        try {
            $stmt = $pdo->prepare('INSERT INTO owner (owner_id) VALUES (?)');
            $stmt->execute([$user_id]);
        } catch (PDOException $e) {
            return [
                'type' => 'danger',
                'message' => sprintf('There was an error: %s', $e->getMessage())
            ];
        }
    } elseif ($form_data['radio'] == 'tenant') {
        try {
            $stmt = $pdo->prepare('INSERT INTO tenant (tenant_id) VALUES (?)');
            $stmt->execute([$user_id]);
        } catch (PDOException $e) {
            return [
                'type' => 'danger',
                'message' => sprintf('There was an error: %s', $e->getMessage())
            ];
        }
    } else {
        return [
            'type' => 'danger',
            'message' => sprintf('No correct role was found.')
        ];
    }

    /* Login user and redirect */
    session_start();
    $_SESSION['user_id'] = $user_id;
    $feedback = [
        'type' => 'success',
        'message' => sprintf('%s, your account was successfully created!', get_user_firstname($pdo, $_SESSION['user_id']))
    ];
    redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
}

// TODO: description
/**
 * @param $pdo
 * @param $form_data
 * @param $files
 * @return array|bool
 */
function add_room($pdo, $form_data, $files) {
    /* Check authorization */
    if (!(check_login() && is_owner($pdo, $_SESSION['user_id']))){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to add a room.'
        ];
    }

    /* Check if all fields are set */
    if (
        empty($form_data['city']) or
        empty($form_data['postal_code']) or
        empty($form_data['street']) or
        empty($form_data['street_number']) or
        empty($form_data['size']) or
        empty($form_data['type']) or
        empty($form_data['price']) or
        empty($form_data['description'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'Please fill in all required fields.'
        ];
    }

    /* Check data type for the phone field */
    if (!is_numeric($form_data['street_number'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Street number\' field.'
        ];
    }

    /* Check data type for the size field */
    if (!is_numeric($form_data['size'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Size\' field.'
        ];
    }

    /* Check data type for the price field */
    if (!is_numeric($form_data['price'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Price\' field.'
        ];
    }

    /* Check if room address already exists */
    try {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE city = ? AND postal_code = ? AND street = ? AND street_number = ? AND addition = ?');
        $stmt->execute([$form_data['city'], $form_data['postal_code'], $form_data['street'], $form_data['street_number'], $form_data['addition']]);
        $room_exists = $stmt->rowCount();
    } catch (\PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Return error message for existing address */
    if ( !empty($room_exists) ) {
        return [
            'type' => 'danger',
            'message' => 'This room cannot be changed. The entered address already exists.'
        ];
    }

    /* Perform file checks */
    foreach ($files['files']['name'] as $key => $value) {
        $filetype = strtolower(pathinfo($files['files']['name'][$key],PATHINFO_EXTENSION));
        /* Check if file is a real or fake image */
        if (getimagesize($files['files']['tmp_name'][$key]) == false) {
            return [
                'type' => 'danger',
                'message' => sprintf('File %s is not an image.', $files['files']['name'][$key])
            ];
        }
        /* Check file size */
        if ($files['files']['size'][$key] > 1000000) {
            return [
                'type' => 'danger',
                'message' => sprintf('File %s is too large.', $files['files']['name'][$key]),
            ];
        }
        /* Limit file type */
        if ($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg") {
            return [
                'type' => 'danger',
                'message' => sprintf('File %s is not an image.', $files['files']['name'][$key])
            ];
        }
    }

    /* Save room to the database*/
    try {
        $stmt = $pdo->prepare('INSERT INTO rooms (owner_id, city, postal_code, street, street_number, addition, size, type, price, 
                               description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $form_data['city'], $form_data['postal_code'], $form_data['street'], $form_data['street_number'], $form_data['addition'],
            $form_data['size'], $form_data['type'], $form_data['price'], $form_data['description']]);
        $room_id = $pdo->lastInsertId();
    } catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }
    /* Save images to folder */
    save_images(create_image_folder($room_id), $files);

    /* Redirect to room page */
    $feedback = [
        'type' => 'success',
        'message' => sprintf('The room was successfully created!')
    ];
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $room_id, json_encode($feedback)));
}

// TODO: description
/**
 * @param $pdo
 * @param $form_data
 * @return array
 */
function opt_in($pdo, $form_data) {
    /* Check authorization */
    if (!(check_login() && is_tenant($pdo, $_SESSION['user_id']))){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to apply for this room.'
        ];
    }
    /* Check if all fields are set */
    if (empty($form_data['message'])){
        return [
            'type' => 'danger',
            'message' => 'Please enter a message.'
        ];
    }

    /* Get room information */
    $room_info = get_room_info($pdo, $form_data['room_id']);

    /* Check if user has already applied for this room */
    try {
        $stmt = $pdo->prepare('SELECT * FROM optin WHERE tenant_id = ? AND room_id = ?');
        $stmt->execute([$_SESSION['user_id'], $form_data['room_id']]);
        $msg_exists = $stmt->rowCount();
    } catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Return error message for existing application */
    if (!empty($msg_exists)){
        return [
            'type' => 'danger',
            'message' => 'You have already applied for this room.'
        ];
    }

    /* Save application to the database */
    try {
        $stmt = $pdo->prepare('INSERT INTO optin (tenant_id, room_id, message) VALUES (?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $form_data['room_id'], $form_data['message']]);
    } catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Redirect to room page */
    $feedback = [
        'type' => 'success',
        'message' => sprintf('You have successfully applied for %s %d%s %s', $room_info['street'],
            $room_info['street_number'], $room_info['addition'], $room_info['city'])
    ];
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $form_data['room_id'], json_encode($feedback)));
}

/*
 * --------------------
 * END: DATABASE INSERT
 * --------------------
 */


/*
 * -------------------
 * START: IMAGE UPLOAD
 * -------------------
 */

/**
 * Creates a new folder that will store the images uploaded to a new room
 * @param int $room_id
 * @return string $path
 */
function create_image_folder($room_id) {
    $path = 'resources/rooms/' . $room_id . '/';
    mkdir($path, 0777, true);
    return $path;
}

/**
 * Renames and uploads all images to the correct location
 * @param $uploaddir
 * @param $files
 */
function save_images($uploaddir, $files) {
    /* Loop through all uploaded images */
    foreach ($files['files']['name'] as $key => $value) {
        $file = $uploaddir . basename($files['files']['name'][$key]);
        $imagefiletype = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        /* Rename jpeg to jpg*/
        if ($imagefiletype == "jpeg"){
            $imagefiletype = "jpg";
        }
        /* Upload image */
        $uploadfile = $uploaddir . $key . '.' . $imagefiletype;
        move_uploaded_file($files['files']['tmp_name'][$key], $uploadfile);
    }
}

/*
 * -----------------
 * END: IMAGE UPLOAD
 * -----------------
 */


/*
 * ----------------------
 * START: DATABASE UPDATE
 * ----------------------
 */

/**
 * Updates a user in the database
 * @param object $pdo db object
 * @param array $form_data post array
 * @return array
 */
function update_user($pdo, $form_data){
    /* Check authorization */
    if (!(check_login() && $form_data['user_id'] == $_SESSION['user_id'])){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to edit this account.'
        ];
    }

    $stmt = $pdo->prepare('SELECT password, firstname, lastname, email, birthdate, phone, language, occupation, 
                           biography FROM users WHERE id = ?');
    $stmt->execute([$form_data['user_id']]);
    $data = $stmt->fetchAll();
    $user_data = $data[0];
    $current_password = $user_data['password'];

    /* Check if all fields are set */
    $user_id = get_user_id();
    if (
        empty($form_data['firstname']) or
        empty($form_data['lastname']) or
        empty($form_data['email']) or
        empty($form_data['birthdate']) or
        empty($form_data['phone']) or
        empty($form_data['language']) or
        empty($form_data['occupation']) or
        empty($form_data['biography'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. Not all fields were filled in.'
        ];
    }

    /* Check phone number data type */
    if (!is_numeric($form_data['phone'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Phone Number\' field.'
        ];
    }

    /* Check if phone number consists of 10 digits. */
    $amount = strlen($form_data['phone']);
    $max = 10;
    if (!($amount === $max)) {
        return [
            'type' => 'danger',
            'message' => 'Please enter a phone number that consists of 10 digits.'
        ];
    }

    /* Check if new password has been set */
    if (!empty($form_data['password1'])){
        /* Check if old password has been set */
        if (empty($form_data['old-password'])){
            return [
                'type' => 'danger',
                'message' => 'You need to enter your old password to change it.'
            ];
        }
        /* Check if old password matches */
        if (!password_verify($form_data['old-password'], $current_password)){
            return [
                'type' => 'danger',
                'message' => 'Your entered \'old password\' does not match your current password.'
            ];
        }
        /* Check if new password matches confirmation */
        if ($form_data['password1'] != $form_data['password2']){
            return [
                'type' => 'danger',
                'message' => 'The confirmation does not match your new password.'
            ];
        }
        /* Check if new password matches old password */
        if ($form_data['password1'] == $form_data['old-password']){
            return [
                'type' => 'warning',
                'message' => 'You cannot enter your current password as your new password.'
            ];
        }
        /* Hash password */
        $password = password_hash($form_data['password1'], PASSWORD_DEFAULT);

        /* Update Account information */
        $stmt1 = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt1->execute([$password, $user_id]);
        $updated1 = $stmt1->rowCount();
    }

    /* Update personal information*/
    $stmt2 = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, 
                            phone = ?, birthdate = ?, language = ?, occupation = ?, biography = ? WHERE id = ?");
    $stmt2->execute([$form_data['firstname'], $form_data['lastname'], $form_data['email'], $form_data['phone'],
        $form_data['birthdate'], $form_data['language'], $form_data['occupation'], $form_data['biography'], $user_id]);
    $updated2 = $stmt2->rowCount();
    if ($updated1 ==  1 or $updated2 == 1) {
        $feedback = [
            'type' => 'success',
            'message' => sprintf("%s, your profile was successfully updated.", $form_data['firstname'])
        ];
    }
    else {
        $feedback = [
            'type' => 'warning',
            'message' => 'Your profile was not edited. No changes were detected'
        ];
    }
    redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
}

// TODO: description
/**
 * @param $pdo
 * @param $form_data
 * @return array
 */
function update_room($pdo, $form_data) {
    /* Get current room address */
    $stmt = $pdo->prepare('SELECT owner_id, street, street_number, addition, city FROM rooms WHERE id = ?');
    $stmt->execute([$form_data['room_id']]);
    $data = $stmt->fetch();
    $current_address = sprintf('%s %d%s %s', $data['street'], $data['street_number'], $data['addition'], $data['city']);
    $form_address = sprintf('%s %d%s %s', $form_data['street'], $form_data['street_number'], $form_data['addition'], $form_data['city']);

    /* Check authorization */
    if (!(check_login() && $data['owner_id'] == $_SESSION['user_id'])){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to edit this room.'
        ];
    }

    /* Check if all fields are filled in */
    if (
        empty($form_data['city']) or
        empty($form_data['postal_code']) or
        empty($form_data['street']) or
        empty($form_data['street_number']) or
        empty($form_data['size']) or
        empty($form_data['type']) or
        empty($form_data['price']) or
        empty($form_data['description'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. Not all fields were filled in.'
        ];
    }
    /* Check if fields that have to be numeric are numeric */

    /* Check data type for the phone field */
    if (!is_numeric($form_data['street_number'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Street number\' field.'
        ];
    }

    /* Check data type for the size field */
    if (!is_numeric($form_data['size'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Size\' field.'
        ];
    }

    /* Check data type for the price field */
    if (!is_numeric($form_data['price'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Price\' field.'
        ];
    }

    /* Check if room address already exists */
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE street = ? AND street_number = ? AND addition = ? AND city = ?');
    $stmt->execute([$form_data['street'], $form_data['street_number'], $form_data['addition'], $form_data['city']]);
    $data = $stmt->fetch();
    $room = sprintf('%s %d%s %s', $data['street'], $data['street_number'], $data['addition'], $data['city']);
    if ($form_address == $room and $room != $current_address) {
        return [
            'type' => 'danger',
            'message' => 'This room cannot be changed. The entered address already exists.'
        ];
    }

    /* Update room information and save to the database */
    $stmt = $pdo->prepare("UPDATE rooms SET city = ?, postal_code = ?, street = ?, 
                            street_number = ?, addition = ?, size = ?, type = ?, price = ?, description = ? WHERE id = ?");
    $stmt->execute([
        $form_data['city'],
        $form_data['postal_code'],
        $form_data['street'],
        $form_data['street_number'],
        $form_data['addition'],
        $form_data['size'],
        $form_data['type'],
        $form_data['price'],
        $form_data['description'],
        $form_data['room_id']
    ]);
    $updated = $stmt->rowCount();
    if ($updated ==  1) {
        $feedback = [
            'type' => 'success',
            'message' => sprintf("%s %d%s was successfully updated.", $form_data['street'],
                $form_data['street_number'], $form_data['addition'])
        ];
    }
    else {
        $feedback = [
            'type' => 'warning',
            'message' => 'The room was not edited. No changes were detected'
        ];
    }
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $form_data['room_id'], json_encode($feedback)));
}


/*
 * --------------------
 * END: DATABASE UPDATE
 * --------------------
 */


/*
 * ----------------------
 * START: DATABASE REMOVE
 * ----------------------
 */

/**
 * Removes a room from the database
 * @param $pdo
 * @param $room_id
 * @return array
 */
function remove_room($pdo, $room_id) {
    /* Get room information */
    $room_info = get_room_info($pdo, $room_id);

    /* Check authorization */
    if (!(check_login() && $room_info['owner_id'] == $_SESSION['user_id'])){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to remove this room.'
        ];
    }

    /* Remove the room images */
    $target = 'resources/rooms/' . $room_id . '/';
    delete_files($target);

    /* Delete room */
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->execute([$room_id]);
    $deleted = $stmt->rowCount();
    if ($deleted ==  1) {
        return [
            'type' => 'success',
            'message' => sprintf("%s %d%s %s was successfully removed.", $room_info['street'],
                $room_info['street_number'], $room_info['addition'], $room_info['city'])
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'An error occurred. The room was not removed.'
        ];
    }
}

/**
 * Recursively delete a directory
 * Source: https://paulund.co.uk/php-delete-directory-and-files-in-directory
 * @param $target
 */
function delete_files($target) {
    if(is_dir($target)){
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
        foreach($files as $file){
            delete_files($file);
        }
        rmdir($target);

    } elseif(is_file($target)) {
        unlink($target);
    }
}

/**
 * Removes a users account from the database
 * @param $pdo
 * @param $user_id
 * @return array
 */
function remove_account($pdo, $user_id) {
    /* Get user information */
    $user_info = get_user_info($pdo, $user_id);

    /* Check authorization */
    if (!(check_login() && $user_id == $_SESSION['user_id'])){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to remove this account.'
        ];
    }

    /* Delete room */
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $deleted = $stmt->rowCount();
    if ($deleted ==  1) {
        logout_user();
        return [
            'type' => 'success',
            'message' => sprintf("%s, your account was successfully removed.", $user_info['firstname'])
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'An error occurred. Your account was not removed.'
        ];
    }
}

/**
 * Removes opt-in for given user and room
 * @param $pdo
 * @param $form_data
 * @return array
 */
function opt_out($pdo, $form_data) {
    /* Check authorization */
    if (!(check_login() && is_tenant($pdo, $form_data['tenant_id']))){
        return [
            'type' => 'danger',
            'message' => 'You are not authorized to remove this application.'
        ];
    }

    /* Get room information */
    $room_info = get_room_info($pdo, $form_data['room_id']);

    /* Delete application */
    $stmt = $pdo->prepare("DELETE FROM optin WHERE tenant_id = ? AND room_id = ?");
    $stmt->execute([$form_data['tenant_id'], $form_data['room_id']]);
    $deleted = $stmt->rowCount();
    if ($deleted ==  1) {
        return [
            'type' => 'success',
            'message' => sprintf("Your application for %s %d%s %s was successfully removed.",
                $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city'])
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'An error occurred. Your application was not removed.'
        ];
    }
}

/*
 * --------------------
 * END: DATABASE REMOVE
 * --------------------
 */
