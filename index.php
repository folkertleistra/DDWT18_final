<?php
/**
 * Controller
 * User: folkertleistra, Thijmen Dam, Hylke van der Veen
 * Date: 15/12/2018
 * Time: 15:51
 */

include 'model.php';

/* Connect to DB */
//$db = connect_db('','','','');

/* HTML view head upper content */
$head_upper_content = '<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Custom Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Vidaloka" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="/DDWT18_final/css/main.css">';

/* Imported scripts */
$imported_scripts ='
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="/DDWT_final/js/main.js"></script>';

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
            'url' => '/DDDWT18_final/login/',
            'state' => 'logout',
            'role' => 'all'
        ),
        6 => Array(
            'name' => 'Logout',
            'url' => '/DDDWT18_final/logout/',
            'state' => 'login',
            'role' => 'all'
        )

    );

/* This section contains all routes */
/* Landing page for ApartRent. (GET) */
if (new_route('/DDWT18_final/', 'get')) {
    /* page info */
    $page_title = 'Home';
    $navigation = get_navigation($nav_template, 1);
    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';

    include use_template('home');
}

/* rooms for rent page. (GET) */
elseif (new_route('/DDWT18_final/rentable-rooms/', 'get')) {
    /* page info */
    $page_title = 'Rooms for rent';
    $navigation = get_navigation($nav_template, 2);
    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';

    include use_template('home');
}

/* information about a single room. (GET) */
elseif (new_route('/DDWT18_final/room/', 'get')) {
    /* get ID of the room */
    //$room_id = $_GET['room_id']
    include use_template('');
}

/* Register an user. (POST) */
elseif (new_route('/DDWT18_final/register/', 'get')) {

}

/* Register an user. (POST) */
elseif (new_route('/DDWT18_final/register/', 'post')) {

}

/* Login an user. (GET) */
elseif (new_route('/DDWT18_final/login/', 'post')) {

}

/* Login an user. (POST) */
elseif (new_route('/DDWT18_final/login/', 'post')) {

}












/* Route for OWNERS to add a room. (GET) */
elseif (new_route('/DDWT18_final/add/', 'get')) {
    /* page info */
    $page_title = 'Add a room';
    /*page content */
}

/* Route for OWNERS to add a room. (POST) */
elseif (new_route('/DDWT18_final/add/', 'post')) {

}




else {
    http_response_code(404);
}