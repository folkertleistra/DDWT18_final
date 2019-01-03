<?php
/**
 * Controller
 * User: folkertleistra, Thijmen Dam, Hylke van der Veen
 * Date: 15/12/2018
 * Time: 15:51
 */

include 'model.php';

/* Connect to DB */
$db = connect_db('localhost','ddwt18_final','ddwt18','ddwt18');

/* HTML views - head upper content */
$head_upper_content = get_head_upper_content();

/* Imported scripts */
$imported_scripts = get_imported_scripts();

/* Footer HTML content */
$footer = get_footer_content();

/* Global login check */
if (check_login()){
    $state = 'login';
}
else {
    $state = 'logout';
}

/* Navigation template */
$nav_template =
    Array(
        1 => Array(
            'name' => 'Home',
            'url' => '/DDWT18_final/',
            'state' => 'all',
            'role' => 'all'
        ),
        2 => Array(
            'name' => 'Rooms for rent',
            'url' => '/DDWT18_final/rentable-rooms/',
            'state' => 'all',
            'role' => 'all'
        ),
        3 => Array(
            'name' => 'My account',
            'url' => '/DDWT18_final/my-account/',
            'state' => 'login',
            'role' => 'all'
        ),
        4 => Array(
            'name' => 'Register',
            'url' => '/DDWT18_final/register/',
            'state' => 'logout',
            'role' => 'all'
        ),
        5 => Array(
            'name' => 'Login',
            'url' => '/DDWT18_final/login/',
            'state' => 'logout',
            'role' => 'all'
        ),
        6 => Array(
            'name' => 'Logout',
            'url' => '/DDWT18_final/logout/',
            'state' => 'login',
            'role' => 'all'
        )
    );

/*
 * -------------
 * START: ROUTES
 * -------------
 */

/* Landing page (GET) */
if (new_route('/DDWT18_final/', 'get')) {
    /* Page content */
    $page_title = 'Home';
    $navigation = get_navigation($nav_template, 1, $state);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('home');
}

/* Room overview (GET) */
elseif (new_route('/DDWT18_final/rentable-rooms/', 'get')) {
    /* Page content */
    $page_title = 'Rooms for rent';
    $navigation = get_navigation($nav_template, 2, $state);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('rentable-rooms');
}

/* test route (GET)
TODO: remove before handing in
*/
elseif (new_route('/DDWT18_final/test-route/', 'get')) {
    /* page info */
    $page_title = 'Rooms for rent';

    $navigation = get_navigation($nav_template, 2, $state);
    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';
    echo '<br/><br/><br/><br/>';

    include use_template('test-route');
}

/* test route (POST)
TODO: remove before handing in
*/
elseif (new_route('/DDWT18_final/test-route/', 'post')) {

    $error_msg = upload_image();
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($error_msg)));
}

/* Single room (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    /* Page content */
    $page_title = "Single room";
    $navigation = get_navigation($nav_template, 0, $state);

    /* get room id */
    $room_id = $_GET['id'];

    /* get room info */
    $room_info = get_room_info($db, $room_id);

    /* room images */
    $room_images = get_images($room_id);

    /* page subtitle */
    $page_subtitle = sprintf('%s %d%s, %s',
        $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city']);

    /* Thumbnail */
    $thumbnail = get_images($room_id)[0];

    include use_template('single-room');

}

elseif (new_route('/DDWT18_final/my-account/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }

    /* Page content */
    $page_title = "My Account";
    $navigation = get_navigation($nav_template, 3, $state);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('my_account');
}


/*
 * --------------------------
 * START: USER AUTHENTICATION
 * --------------------------
 */

/* Register user (GET) */
elseif (new_route('/DDWT18_final/register/', 'get')) {
    /* Page content */
    $page_title = 'Register';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('register');
}

/* Register user (POST) */
elseif (new_route('/DDWT18_final/register/', 'post')) {
    /* Register user */
    $error_msg = register_user($db, $_POST);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($error_msg)));
}

/* Login user (GET) */
elseif (new_route('/DDWT18_final/login/', 'get')) {
    /* Page content */
    $navigation = get_navigation($nav_template, 5, $state);
    $page_title = 'Login';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('login');
}

/* Login user (POST) */
elseif (new_route('/DDWT18_final/login/', 'post')) {
    /* Login user */
    $error_msg = login_user($db, $_POST);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/my-account/?id=%s', $_POST['id']));
}

/* Logout user (GET) */
elseif (new_route('/DDWT18_final/logout/', 'get')) {
    /* Logout user */
    $error_msg = logout_user();

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($error_msg)));
}

/*
 * ------------------------
 * END: USER AUTHENTICATION
 * ------------------------
 */


/*
 * -----------------
 * START: OWNER ONLY
 * -----------------
 */

/* Add room (GET) */
elseif (new_route('/DDWT18_final/add/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    $page_title = 'Add room';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('add-room');
}

/* Add room (POST) */
elseif (new_route('/DDWT18_final/add/', 'post')) {
    /* Add room */
    $error_msg = add_room($db, $_POST);

    /* Redirect to add (GET) page */
    redirect(sprintf('/DDWT18_final/add/?error_msg=%s', json_encode($error_msg)));
}

/* Edit room (GET) */
elseif (new_route('/DDWT18_final/edit/', 'get')) {

}

/* Edit room (POST) */
elseif (new_route('/DDWT18_final/edit/', 'post')) {

}

/* Remove room (POST) */
elseif (new_route('/DDWT18_final/remove/', 'post')) {

}

/*
 * ---------------
 * END: OWNER ONLY
 * ---------------
 */


/*
 * ------------------
 * START: TENANT ONLY
 * ------------------
 */

/* Opt-in to a room (POST) */
elseif (new_route('/DDWT18_final/optin/', 'post')) {

}

/*
 * ----------------
 * END: TENANT ONLY
 * ----------------
 */

/* Exception */
else {
    http_response_code(404);
}

/*
 * -----------
 * END: ROUTES
 * -----------
 */