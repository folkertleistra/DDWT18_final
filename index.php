<?php
/**
 * Controller
 * User: Thijmen Dam, Folkert Leistra, Hylke van der Veen
 * Date: 09-01-2019
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
    /* get user id */
    $global_id = get_user_id();
    if (get_role($db, $global_id) == 'owner') {
        $role = 'owner';
    } else {
        $role = 'all';
    }
} else {
    $state = 'logout';
    $role = 'all';
}

/* Header title */
$header_title = "ApartRent";

/* Navigation template */
$nav_template =
    Array(
        1 => Array(
            'name' => 'Home',
            'url' => '/DDWT18_final/',
            'state' => 'neutral',
            'role' => 'all'
        ),
        2 => Array(
            'name' => 'Rooms for rent',
            'url' => '/DDWT18_final/rentable-rooms/',
            'state' => 'neutral',
            'role' => 'all'
        ),
        3 => Array(
            'name' => 'Add room',
            'url' => '/DDWT18_final/add-room/',
            'state' => 'login',
            'role' => 'owner'
        ),
        4 => Array(
            'name' => 'My account',
            'url' => '/DDWT18_final/my-account/',
            'state' => 'login',
            'role' => 'all'
        ),
        5 => Array(
            'name' => 'Register',
            'url' => '/DDWT18_final/register/',
            'state' => 'logout',
            'role' => 'all'
        ),
        6 => Array(
            'name' => 'Login',
            'url' => '/DDWT18_final/login/',
            'state' => 'logout',
            'role' => 'all'
        ),
        7 => Array(
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
    $header_subtitle = 'Room for everyone';
    $navigation = get_navigation($nav_template, 1, $state, $role);
    $room_amnt = count_rooms($db);
    $tenant_amnt = count_tenants($db);
    $owner_amnt = count_owners($db);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Page content */
    $room_amnt = count_rooms($db);
    $tenant_amnt = count_tenants($db);
    $owner_amnt = count_owners($db);
    $header_subtitle = 'Room for everyone';

    /* Intro text button */
    $intro_btn = get_intro_button($db);

    /* Featured room */
    $room_id = get_random_room_id($db);
    $room_info = get_room_info($db, $room_id);
    $room_images = get_images($room_id);
    $address = get_room_address($db, $room_id);

    /* Choose template */
    include use_template('home');
}

/* Room overview (GET) */
elseif (new_route('/DDWT18_final/rentable-rooms/', 'get')) {
    /* Page content */
    $page_title = 'Rooms for rent';
    $header_subtitle = 'All available rooms';
    $navigation = get_navigation($nav_template, 2, $state, $role);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('rentable-rooms');
}

/* Single room (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    /* Check if logged in */
    if (!check_login()){
        $login = false;
    } else {
        $login = true;
    }

    /* Get room id */
    $room_id = $_GET['id'];

    /* Get room info */
    $room_info = get_room_info($db, $room_id);

    /* Check if room exists */
    if ( empty($room_info)){
        $feedback = [
            'type' => 'danger',
            'message' => 'The requested room does not exist.'
        ];
        redirect(sprintf('/DDWT18_final/rentable-rooms/?error_msg=%s', json_encode($feedback)));
    }

    /* Page content */
    $page_title =  $header_subtitle =sprintf('%s %d%s, %s',
        $room_info['street'], $room_info['street_number'], $room_info['addition'], $room_info['city']);
    $navigation = get_navigation($nav_template, 0, $state, $role);

    /* Goom images */
    $room_images = get_images($room_id);

    /* Check if the current user is the owner of the room */
    $user_id = get_user_id();

    /* Thumbnail */
    $thumbnail = get_images($room_id)[0];

    /* Address string */
    $address = get_room_address($db, $room_id);

    /* Check if the current user is the owner of the room */
    $user_id = get_user_id();
    if (owns_room($db, $room_id, $user_id)) {
        $display_buttons = true;
    } else {
        $display_buttons = false;
    }

    /* Check if the current user is a tenant */
    if (is_tenant($db, $user_id)) {
        $display_optin = true;
        /* check if the tenant has already opted in */
        if (opted_in($db, $room_id, $user_id)) {
            $display_optout = true;
            $message = get_optin_message($db, $room_id, $user_id);
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

    /* Choose template */
    include use_template('single-room');
}

/*
 * --------------
 * START: ACCOUNT
 * --------------
 */

/* My account (GET) */
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
    $header_subtitle = $page_title = "My Account";
    $navigation = get_navigation($nav_template, 4, $state, $role);
    $personal_info = get_personal_info_html($db, $user_info);

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('my-account');
}

/* Edit account (GET) */
elseif (new_route('/DDWT18_final/edit-account/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }

    /* Page content */
    $header_subtitle = $page_title = 'Edit account';
    $navigation = get_navigation($nav_template, 4, $state, $role);

    /* Get the ID of the user from the session */
    $user_id = $_SESSION['user_id'];

    /* Retrieve the information about the user from the database or GET */
    if ( isset($_GET['user_info'])){
        $user_info = json_decode($_GET['user_info'], true);
    } else {
        $user_info = get_user_info($db, $user_id);
    }

    /* Get error message from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('edit-account');
}

/* Edit account (POST) */
elseif (new_route('/DDWT18_final/edit-account/', 'post')) {
    /* Update the user account */
    $feedback = update_user($db, $_POST);

    /* Redirect to edit account route */
    redirect(sprintf('/DDWT18_final/edit-account/?error_msg=%s&user_info=%s', json_encode($feedback), json_encode($_POST)));
}

/* Remove account (POST) */
elseif (new_route('/DDWT18_final/remove-account/', 'post')) {
    /* Remove account */
    $feedback = remove_account($db, $_POST['user_id']);

    /* Redirect to homepage */
    redirect(sprintf('/DDWT18_final/?error_msg=%s', json_encode($feedback)));
}

/*
 * ------------
 * END: ACCOUNT
 * ------------
 */


/*
 * --------------------------
 * START: USER AUTHENTICATION
 * --------------------------
 */

/* Register user (GET) */
elseif (new_route('/DDWT18_final/register/', 'get')) {
    /* Check if logged in */
    if ( check_login() ) {
        redirect('/DDWT18_final/my-account/');
    }

    /* Page content */
    $page_title = 'Register';

    /* Fill in form inputs */
    if (isset($_GET['form_data'])){
        $form_data = json_decode($_GET['form_data'], true);
    }

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
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
    /* Check if logged in */
    if ( check_login() ) {
        redirect('/DDWT18_final/my-account/');
    }

    /* Page content */
    $navigation = get_navigation($nav_template, 6, $state, $role);
    $page_title = 'Login';

    /* Get error message from POST route */
    if (isset($_GET['error_msg'])){
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
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

    /* Check if owner */
    if (!is_owner($db, $_SESSION['user_id'])){
        $error_msg = [
            'type' => 'danger',
            'message' => 'You are not authorized to add a room.'
        ];
        redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($error_msg)));
    }

    /* Fill in the form data */
    if (isset($_GET['room_info'])){
        $room_info = json_decode($_GET['room_info'], true);
    }

    /* Page content */
    $header_subtitle = 'Add a room';
    $page_title = 'Add room';
    $navigation = get_navigation($nav_template, 3, $state, $role);
    $form_action = '/DDWT18_final/add-room/';
    $submit_btn = "Add room";

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
    redirect(sprintf('/DDWT18_final/add-room/?error_msg=%s&room_info=%s', json_encode($error_msg), json_encode($_POST)));
}

/* Edit room (GET) */
elseif (new_route('/DDWT18_final/edit-room/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ) {
        redirect('/DDWT18_final/login/');
    }

    /* Page content */
    $header_subtitle = $page_title = "Edit room";

    /* Get room info from db */
    $room_id = $_GET['id'];

    /* Fill in the form inputs */
    if (isset($_GET['room_info'])){
        $room_info = json_decode($_GET['room_info'], true);
    } else {
        $room_info = get_room_info($db, $room_id);
    }

    /* Check if room owner */
    if ( !owns_room($db, $room_id, $_SESSION['user_id'])) {
        $error_msg = [
            'type' => 'danger',
            'message' => 'You are not authorized to edit this room.'
        ];
        /* Redirect to single room page */
        redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $room_id, json_encode($error_msg)));
    }

    /* Page content */
    $header_subtitle = 'Edit your room';
    $form_action = '/DDWT18_final/edit-room/';
    $submit_btn = 'Edit room';
    $navigation = get_navigation($nav_template, 2, $state, $role);
    $submit_btn = 'Edit';
    $navigation = get_navigation($nav_template, 2, $state, $role);

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('add-edit-room');
}

/* Edit room (POST) */
elseif (new_route('/DDWT18_final/edit-room/', 'post')) {
    /* Edit room in database */
    $feedback = update_room($db, $_POST);

    /* Redirect to edit-room GET route */
    redirect(sprintf('/DDWT18_final/edit-room/?id=%s&error_msg=%s&room_info=%s', $_POST['room_id'], json_encode($feedback), json_encode($_POST)));

    /* Choose template */
    include use_template('add-edit-room');
}

/* Remove room (POST) */
elseif (new_route('/DDWT18_final/remove-room/', 'post')) {
    /* Remove room from the database */
    $feedback = remove_room($db, $_POST['room_id']);

    /* Redirect to add (GET) page */
    redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
}

/* User profile (GET) */
elseif (new_route('/DDWT18_final/profile/', 'get')) {
    /* Check if logged in */
    if ( !check_login() ){
        redirect('/DDWT18_final/login/');
    }

    /* Check if owner */
    if ( !is_owner($db, $_SESSION['user_id'])) {
        $error_msg = [
            'type' => 'danger',
            'message' => 'You have to be an owner to look at this profile.'
        ];
        redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($error_msg)));
    }

    /* Get user information */
    $user_id = $_GET['id'];
    $user_info = get_user_info($db, $user_id);

    /* Check if room exists */
    if ( empty($user_info)){
        $feedback = [
            'type' => 'danger',
            'message' => 'The requested profile does not exist.'
        ];
        redirect(sprintf('/DDWT18_final/my-account/?error_msg=%s', json_encode($feedback)));
    }

    /* Get user name */
    $name = sprintf('%s %s', $user_info['firstname'], $user_info['lastname']);

    /* Page content */
    $page_title = $name;
    $navigation = get_navigation($nav_template, 0, $state, $role);
    $personal_info = get_personal_info_html($db, $user_info);

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('profile');
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
    /* Opt-in a user to a room */
    $feedback = opt_in($db, $_POST);

    /* Redirect to single room page */
    redirect(sprintf('/DDWT18_final/room/?id=%s&error_msg=%s', $_POST['room_id'], json_encode($feedback)));
}

/* Opt-out to a room (POST) */
elseif (new_route('/DDWT18_final/optout/', 'post')) {
    /* Opt-out a user from a room */
    $feedback = opt_out($db, $_POST);

    /* Redirect to single room page */
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
