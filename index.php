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


$nav_template =
    Array(
        1 => Array(
            'name' => 'Home',
            'url' => '/DDWT18_final/'
        ),
        2 => Array(
            'name' => 'Overview',
            'url' => '/DDWT18_final'
        ),
        3 => Array(
            'name' => 'My Account',
            'url' => '/DDWT18_final'
        ),
        4 => Array(
            'name' => 'Register',
            'url' => '/DDWT18_final'
        ),
        5 => Array(
            'name'=> 'Login',
            'url' => '/DDWT18_final'
        )
    );

/* This section contains all routes */
if (new_route('/DDWT18_final/', 'get')) {
    $page_title = 'Home';
    $navigation = get_navigation($nav_template, 1);

    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';

    include use_template('main');
}



else {
    http_response_code(404);
}