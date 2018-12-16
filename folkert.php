<?php
/**
 * Created by PhpStorm.
 * User: folkertleistra
 * Date: 16/12/2018
 * Time: 15:30
 */

/**
 * login a user to the database
 * @param object $pdo database object
 * @parim array $form_data with POST data
 * @return array
 */
function login_user($pdo, $form_data){
    /* Check if all fields are set */
    if (
        empty($form_data['username']) or
        empty($form_data['password'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'You should enter a username and password.'
        ];
    }
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$form_data['username']]);
        $user_info = $stmt->fetch();
    } catch (\PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }
    /* Return error message for wrong username */
    if ( empty($user_info) ) {
        return  [
            'type' => 'danger',
            'message' => 'The username you entered does not exist!'
        ];
    }
    /* Check password */
    if ( !password_verify($form_data['password'], $user_info['password']) ){
        return [
            'type' => 'danger',
            'message' => 'The password you entered is incorrect!'
        ];
    } else {
        session_start();
        $_SESSION['user_id'] = $user_info['id'];
        $feedback = [
            'type' => 'success',
            'message' => sprintf('%s, you were logged in successfully!',
                get_name($pdo, $_SESSION['user_id']))
        ];
        redirect(sprintf('/DDWT18/week2/myaccount/?error_msg=%s',
            json_encode($feedback)));

    }
}