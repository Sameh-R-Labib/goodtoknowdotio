<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/12/18
 * Time: 9:47 PM
 */

namespace GoodToKnow\Controllers;


class Logout
{
    function page()
    {
        /**
         * The purpose is to destroy the session file
         * then redirect to the login page.
         */
        $_SESSION = [];
        session_destroy();
        redirect_to("/ax1/LoginForm/page");
    }
}