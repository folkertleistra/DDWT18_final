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
function connect_db($host, $db, $user, $pass){
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
 * Check if the route exist
 * @param string $route_uri URI to be matched
 * @param string $request_type request method
 * @return bool
 *
 */
function new_route($route_uri, $request_type){
    $route_uri_expl = array_filter(explode('/', $route_uri));
    $current_path_expl = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    if ($route_uri_expl == $current_path_expl && $_SERVER['REQUEST_METHOD'] == strtoupper($request_type)) {
        return True;
    }
}

/**
 * Creates a new navigation array item using url and active status
 * @param string $url The url of the navigation item
 * @param bool $active Set the navigation item to active or inactive
 * @return array
 */
function na($url, $active){
    return [$url, $active];
}

/**
 * Creates filename to the template
 * @param string $template filename of the template without extension
 * @return string
 */
function use_template($template){
    $template_doc = sprintf("views/%s.php", $template);
    return $template_doc;
}

/**
 * Creates navigation HTML code using given array
 * @param array $navigation Array with as Key the page name and as Value the corresponding url
 * @return string html code that represents the navigation
 */
function get_navigation($template, $active_id, $state){
    $navigation_exp = '
    <nav class="navbar fixed-top navbar-expand-lg navbar-light">
    <a class="navbar-brand">
        <img src="/DDWT18_final/resources/logo/apartrent-logo.png" class="navbar-logo" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';
    foreach ($template as $name => $info) {
        if ($info['state'] == $state or $info['state'] == 'all') {
            /* makes the active url bold */
            if ($name == $active_id) {
                $navigation_exp .= '<li class="nav-item active">';
                $navigation_exp .= '<a class="nav-link" href="' . $template[$active_id]['url'] . '">' . $template[$active_id]['name'] . '</a>';
            }
            else {
                $navigation_exp .= '<li class="nav-item">';
                $navigation_exp .= '<a class="nav-link" href="' . $info['url'] . '">' . $info['name'] . '</a>';
            }
            $navigation_exp .= '</li>';

        }

    }
    $navigation_exp .= '
    </ul>
    </div>
    </nav>';
    return $navigation_exp;
}

/**
 * Pritty Print Array
 * @param $input
 */
function p_print($input){
    echo '<pre>';
    print_r($input);
    echo '</pre>';
}


/**
 * Returns the HTML head upper content in HTML code
 * @return string
 */
function get_head_upper_content() {
    return '<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Custom Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Vidaloka" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="/DDWT18_final/css/main.css">';
}


/**
 * Returns imported scripts HTML
 * @return string
 */
function get_imported_scripts() {
    return '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="/DDWT_final/js/main.js"></script>';
}

function get_footer_content() {
    return '<footer class="page-footer font-small">
        <div class="footer-img-wrapper">
            <img src="/DDWT18_final/resources/logo/apartrent-logo.png" class="navbar-logo" alt="">
        </div>
        <div class="footer-copyright text-center py-3">© <?php echo date("Y") ?> Copyright - ApartRent</div>
        </footer>';
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
    $user = $users[0];
    $user_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($user as $key => $value){
        $user_exp[$key] = htmlspecialchars($value);
    }
    return $user_exp;
}

/**
 * Returns username for a single user
 * @param $pdo
 * @param $user_id
 * @return string
 */
function get_user_username($pdo, $user_id) {
    /* Create and execute SQL statement */
    $stmt = $pdo->prepare('SELECT username FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $users = $stmt->fetchAll();
    $user = $users[0];

    $username = htmlspecialchars($user['username']);
    return $username;
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
    $room = $rooms[0];
    $room_exp = Array();

    /* Create array with htmlspecialchars */
    foreach ($room as $key => $value){
        $room_exp[$key] = htmlspecialchars($value);
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

function register_user($pdo, $form_data) {
    /* Check if all fields are set */
    /* TODO: fix role check */
    if (
        empty($form_data['role']) or
        empty($form_data['firstname']) or
        empty($form_data['lastname']) or
        empty($form_data['username']) or
        empty($form_data['password']) or
        empty($form_data['email']) or
        empty($form_data['phone']) or
        empty($form_data['birthdate']) or
        empty($form_data['language']) or
        empty($form_data['biography'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'Please fill in all fields marked with an \'*\' (asterisk).'
        ];
    }

    /* Check data type for the phone field */
    if (!is_numeric($form_data['phone'])) {
        return [
            'type' => 'danger',
            'message' => 'Please only enter numbers in the \'Phone Number\' field.'
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

    /* Return error message for existing username */
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

    /* Login user and redirect */
    session_start();
    $_SESSION['user_id'] = $user_id;
    $feedback = [
        'type' => 'success',
        'message' => sprintf('%s, your account was successfully created!', get_user_username($pdo, $_SESSION['user_id']))
    ];
    redirect(sprintf('/DDWT18_final/myaccount/?error_msg=%s', json_encode($feedback)));
}

/*
 * --------------------
 * END: DATABASE INSERT
 * --------------------
 */



