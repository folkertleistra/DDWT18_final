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


$template =
    Array(
        1 => Array(
            'name' => 'Home',
            'url' => '/DDWT18_final/'
        ),
        2 => Array(
            'name' => 'Overview',
            'url' => '/DDWT18/week2/overview/'
        ),
        3 => Array(
            'name' => 'My Account',
            'url' => '/DDWT18/week2/myaccount/'
        ),
        4 => Array(
            'name' => 'Register',
            'url' => '/DDWT18/week2/register/'
        ),
        5 => Array(
            'name'=> 'Login',
            'url' => '/DDWT18/week2/login/'
        )
    );

/* This section contains all routes */
if (new_route('/DDWT18_final/', 'get')) {
    $page_title = 'Home';
    $navigation = get_navigation($template, 1);

    /*page content */
    $page_subtitle = 'Living on my own!';
    $page_content = 'Boom Boom Boom Boom, I want you in my room!';
}



else {
    http_response_code(404);
}