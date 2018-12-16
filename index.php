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

/* Navigation template */
$state = 'logout';
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
    print_r(get_user_info($db, 1));
    include use_template('home');
}

/* information about a single room. (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    /* get ID of the room */
    //$room_id = $_GET['room_id']
    include use_template('');
}

elseif (new_route('/DDWT18_final/myaccount/', 'get')) {
    echo 'myaccount';
}


/* THE FOLLOWING SECTION DEALS WITH USER AUTHENTICATION */

/* Register a user. (GET) */
elseif (new_route('/DDWT18_final/register/', 'get')) {
    echo 'register';
}

/* Register a user. (POST) */
elseif (new_route('/DDWT18_final/register/', 'post')) {

}

/* Login a user. (GET) */
elseif (new_route('/DDWT18_final/login/', 'get')) {
    $navigation = get_navigation($nav_template, 5, $state);
    include use_template('login');
}

/* Login a user. (POST) */
elseif (new_route('/DDWT18_final/login/', 'post')) {

}

/* Logout a user. (GET) */
elseif (new_route('/DDWT18_final/logout/', 'get')) {

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