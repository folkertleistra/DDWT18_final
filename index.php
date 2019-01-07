<?php
/**
 * Controller
 * User: folkertleistra, Thijmen Dam, Hylke van der Veen
 * Date: 15/12/2018
 * Time: 15:51
 */

include 'model.php';

/*
 * -------------------
 * START: PAGE CONTENT
 * -------------------
 */

/* Connect to DB */
$db = connect_db('localhost','ddwt18_final','ddwt18','ddwt18');

/* HTML views - head upper content */
$head_upper_content = get_head_upper_content();

/* Imported scripts */
$imported_scripts = get_imported_scripts();

/* Footer HTML content */
$footer = get_footer_content();

/* Global login check for navigation bar */
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
 * -----------------
 * END: PAGE CONTENT
 * -----------------
 */


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
    $room_id = 23;

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
    save_images(create_image_folder(4), $_FILES);

}

/* Single room (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    if (!check_login()){
        $login = false;
    } else {
        $login = true;
    }

    /* get room id */
    $room_id = $_GET['id'];

    /* get room info */
    $room_info = get_room_info($db, $room_id);

    /* Page content */
    $page_title = sprintf('%s %d%s, %s',
        $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city']);
    $navigation = get_navigation($nav_template, 0, $state);

    /* room images */
    $room_images = get_images($room_id);

    /* check if the current user is the owner of the room */
    $user_id = get_user_id();

    /* page subtitle */
    $page_subtitle = sprintf('%s %d%s, %s',
        $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city']);

    /* Thumbnail */
    $thumbnail = get_images($room_id)[0];

    /* Address string */
    $address = get_room_address($db, $room_id);

    /* check if the current user is the owner of the room */
    $user_id = get_user_id();
    if (owns_room($db, $room_id, $user_id)) {
        $display_buttons = true;
    } else {
        $display_buttons = false;
    }

    /* check if the current user is a tenant */
    if (is_tenant($db, $user_id)) {
        $display_optin = true;
        /* check if the tenant has already opted in */
        if (opted_in($db, $room_id, $user_id)) {
            $display_optout = true;
            $display_optin = false;
        } else {
            $display_optout = false;
        }
    } else {
        $display_optin = false;
        $display_optout= false;
    }

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('single-room');

}

elseif (new_route('/DDWT18_final/my-account/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    /* Get the ID of the user from the session */
    $user_id = $_SESSION['user_id'];

    /* Retrieve the information about the user from the database */
    $user_info = get_user_info($db, $user_id);

    /* Page content */
    $page_title = "My Account";
    $page_subtitle = "My Account";
    $navigation = get_navigation($nav_template, 3, $state);
    $personal_info = get_personal_info_html($user_info);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('my-account');
}

/* edit personal-information for (GET) */
elseif (new_route('/DDWT18_final/edit-account/', 'get')) {

    $page_title = 'Edit personal information';
    $navigation = get_navigation($nav_template, 3, $state);

    /* Get the ID of the user from the session */
    $user_id = $_SESSION['user_id'];

    /* Retrieve the information about the user from the database */
    $user_info = get_user_info($db, $user_id);

    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }
    /* choose template */
    include use_template('edit-account');
}

/* edit user-information for (POST) */
elseif (new_route('/DDWT18_final/edit-account/', 'post')) {

    $navigation = get_navigation($nav_template, 3, $state);

    $feedback = update_user($db, $_POST);

    /* Redirect to serie GET route */
    redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s',
        json_encode($feedback)));

    /* choose template */
    include use_template('edit-account');
}

elseif (new_route('/DDWT18_final/remove-account/', 'post')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    $feedback = remove_account($db, $_POST['user_id']);
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($feedback)));
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

    if (isset($_GET['form_data'])){
        $form_data = json_decode($_GET['form_data'], true);
    }
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
    $form_data = get_register_data($_POST);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/register/?error_msg=%s&form_data=%s', json_encode($error_msg), json_encode($form_data)));
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
    redirect(sprintf('/DDWT18_final/login/?error_msg=%s', json_encode($error_msg)));
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
elseif (new_route('/DDWT18_final/add-room/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }
    $page_title = 'Add room';
    $header_title = 'Add a room';

    $form_action = '/DDWT18_final/add-room/';
    $submit_btn = "Add";

    $navigation = get_navigation($nav_template, 2, $state);
    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('add-edit-room');
}

/* Add room (POST) */
elseif (new_route('/DDWT18_final/add-room/', 'post')) {
    /* Add room */
    $error_msg = add_room($db, $_POST, $_FILES);

    /* Redirect to add (GET) page */
    redirect(sprintf('/DDWT18_final/add/?error_msg=%s', json_encode($error_msg)));
}

/* Edit room (GET) */
elseif (new_route('/DDWT18_final/edit-room/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }

    /* Get room info from db */
    $room_id = $_GET['id'];
    $room_info = get_room_info($db, $room_id);
    /* Page content */
    $page_title = 'Edit Room';
    $header_title = 'Edit your room';
    $form_action = '/DDWT18_final/edit-room/';
    $submit_btn = 'Edit';
    $navigation = get_navigation($nav_template, 2, $state);

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }
    /* Choose Template */
    include use_template('add-edit-room');
}

/* Edit room (POST) */
elseif (new_route('/DDWT18_final/edit-room/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT18_final/login/');
    }

    $navigation = get_navigation($nav_template, 2, $state);

    /* edit room in database */
    $feedback = update_room($db, $_POST);

    /* Redirect to serie GET route */
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $_POST['room_id'], json_encode($feedback)));

    /*choose template */
    include use_template('add-edit-room');
}


/* Remove room (POST) */
elseif (new_route('/DDWT18_final/remove-room/', 'post')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }

    $feedback = remove_room($db, $_POST['room_id']);

    /* Redirect to add (GET) page */
    redirect(sprintf('/DDWT18_final/rentable-rooms/?error_msg=%s', json_encode($feedback)));
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
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT18_final/login/');
    }

    $feedback = opt_in($db, $_POST);
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $_POST['room_id'], json_encode($feedback)));
}

/* Opt-out to a room (POST) */
elseif (new_route('/DDWT18_final/optout/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT18_final/login/');
    }

    $feedback = opt_out($db, $_POST);
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $_POST['room_id'], json_encode($feedback)));
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