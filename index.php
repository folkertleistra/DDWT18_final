<?php
/**
 * Controller
 * User: folkertleistra, Thijmen Dam, Hylke van der Veen
 * Date: 15/12/2018
 * Time: 15:51
 */

include 'model.php';

/* Connect to DB */
$db = connect_db('','','','');


$template =
    Array(
        1 => Array(
            'name' => 'Home',
            'url' => '/DDWT18/week2/'
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

/* Landing page */
if (new_route('/DDWT18_final/', 'get')) {
    echo 'WELKOM VIEZE JONGENTJES';
}

/* Overview page */
elseif (new_route('/DDWT18_final/overview/', 'get')) {

}

/* Single Serie */
elseif (new_route('/DDWT18_final/serie/', 'get')) {

}

/* Add serie GET */
elseif (new_route('/DDWT18/week2/add/', 'get')) {

}

/* Add serie POST */
elseif (new_route('/DDWT18/week2/add/', 'post')) {

}

/* Edit serie GET */
elseif (new_route('/DDWT18/week2/edit/', 'get')) {

}

/* Edit serie POST */
elseif (new_route('/DDWT18/week2/edit/', 'post')) {

}


/* Remove serie POST */
elseif (new_route('/DDWT18/week2/remove/', 'post')) {

}

/* my account GET */
elseif (new_route('/DDWT18/week2/myaccount/', 'get')) {


}
/* register GET */
elseif (new_route('/DDWT18/week2/register/', 'get')) {

}

/* register POST */
elseif (new_route('/DDWT18/week2/register/', 'post')) {

}

/* login GET */
elseif (new_route('/DDWT18/week2/login/', 'get')) {


}
/* login POST */
elseif (new_route('/DDWT18/week2/login/', 'post')) {


}
/* logout GET */
elseif (new_route('/DDWT18/week2/logout/', 'get')) {
    $feedback = logout_user();
}
else {
    http_response_code(404);
}