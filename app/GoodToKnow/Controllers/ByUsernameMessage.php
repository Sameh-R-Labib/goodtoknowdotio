<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/8/18
 * Time: 2:00 PM
 */

namespace GoodToKnow\Controllers;


class ByUsernameMessage
{
    public function page()
    {
        /**
         * The goal of this series of routes
         * is to make it possible to message
         * a user if the only thing you know
         * about this user is their username.
         */

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Present a form for entering a username.
         */

        /**
         * Display the editor interface.
         */
        $html_title = 'Username Message a User';

        require VIEWS . DIRSEP . 'byusernamemessage.php';
    }
}