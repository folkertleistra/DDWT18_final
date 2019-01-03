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

/* global login check to determine the state of a user */
if (check_login()){
    $state = 'login';
}
else {
    $state = 'logout';
    // Session killen hier?
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
            'url' => '/DDWT18_final/myaccount/',
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

/* This section contains all routes */
/* Landing page for ApartRent. (GET) */
if (new_route('/DDWT18_final/', 'get')) {
    /* page info */
    $page_title = 'Home';
    $navigation = get_navigation($nav_template, 1, $state);
    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('home');
}

/* rooms for rent page. (GET) */
elseif (new_route('/DDWT18_final/rentable-rooms/', 'get')) {
    /* page info */
    $page_title = 'Rooms for rent';

    $navigation = get_navigation($nav_template, 2, $state);
    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';

    include use_template('rentable-rooms');
}

/* test route (GET) */
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

elseif (new_route('/DDWT18_final/test-route/', 'post')) {

    $error_msg = upload_image();
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($error_msg)));
}

/* single room. (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    /* META */
    $page_title = "Single room";
    $navigation = get_navigation($nav_template, 0, $state);

    /* get ID of the room */
    $room_id = $_GET['id'];

    /* get room info */
    $room_info = get_room_info($db, $room_id);

    /* page subtitle */
    $page_subtitle = sprintf('%s %d%s, %s',
        $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city']);

    /* Thumbnail */
    $thumbnail = get_images($room_id)[0];

    include use_template('single-room');

}

elseif (new_route('/DDWT18_final/myaccount/', 'get')) {
    echo 'myaccount';
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    $page_title = "My Account";
    $navigation = get_navigation($nav_template, 3, $state);
    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('my_account');
}


/* THE FOLLOWING SECTION DEALS WITH USER AUTHENTICATION */

/* Register a user. (GET) */
elseif (new_route('/DDWT18_final/register/', 'get')) {
    $page_title = 'Register';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('register');
}

/* Register a user. (POST) */
elseif (new_route('/DDWT18_final/register/', 'post')) {
    print_r($_POST);
    /* Register user */
    $error_msg = register_user($db, $_POST);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/myaccount/?error_msg=%s', json_encode($error_msg)));
}

/* Login a user. (GET) */
elseif (new_route('/DDWT18_final/login/', 'get')) {
    $navigation = get_navigation($nav_template, 5, $state);
    $page_title = 'Login';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('login');
}

/* Login a user. (POST) */
elseif (new_route('/DDWT18_final/login/', 'post')) {
    /* Login user */
    $error_msg = login_user($db, $_POST);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/myaccount/?id=%s', $_POST['id']));
}

/* Logout a user. (GET) */
elseif (new_route('/DDWT18_final/logout/', 'get')) {
    $error_msg = logout_user();

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($error_msg)));
}

/* END SECTION OF USER AUTHENTICATION */


/* THE FOLLOWING ROUTES ARE ONLY AVAILABLE FOR OWNERS */

/* edit room for. (GET) */
elseif (new_route('/DDWT18_final/edit/', 'get')) {

}

/* edit room for. (POST) */
elseif (new_route('/DDWT18_final/edit/', 'post')) {

}

/* add a room for. (GET) */
elseif (new_route('/DDWT18_final/add/', 'get')) {

}

/* add room for. (POST) */
elseif (new_route('/DDWT18_final/add/', 'post')) {

}

/* Remove a room. (POST) */
/* edit room for an Owner. (GET) */
elseif (new_route('/DDWT18_final/remove/', 'post')) {

}

/* END SECTION CONTAINING ROUTES ONLY AVAILABLE FOR OWNERS */

/* THE FOLLOWING ROUTES ARE ONLY AVAILABLE FOR TENANTS */

/* opt-in to a room. (POST) */
elseif (new_route('/DDWT18_final/optin/', 'post')) {

}

/* END SECTION CONTAINING ROUTES ONLY AVAILABLE FOR TENANTS */

/* ERROR HANDLING WHEN THE ROUTE IS NOT FOUND */
else {
    http_response_code(404);
}