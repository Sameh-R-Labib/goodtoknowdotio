<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/10/18
 * Time: 9:42 PM
 */

namespace GoodToKnow\Controllers;


class LoginScript
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if ($is_logged_in) {
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Variables to work with:
         *   $_POST['username'], $_POST['password']
         */
    }
}