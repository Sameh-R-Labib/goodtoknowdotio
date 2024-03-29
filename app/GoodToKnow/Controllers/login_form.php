<?php

namespace GoodToKnow\Controllers;

class login_form
{
    function page()
    {
        global $g;


        /**
         * We do not want to show the login form if the user is already logged in. In other words if
         * $g->is_logged_in is set to true (per session file) and the user was redirected here then
         * there is the possibility the user is experiencing an infinite loop situation (which we
         * must stop.)
         *
         * If there is no session file for the user or if $g->is_logged_in is set to false then
         * we want to show loginform.php.
         */

        if ($g->is_logged_in) {

            breakout('');

        }


        /**
         * At this point:
         *   The user may have a session (although he / she is not logged in.)
         *   So, lets destroy the session (We still have the session message stored in $g->message.)
         *
         *  Doing this helps prevent infinite loops.
         */

        $_SESSION = [];
        session_destroy();


        /**
         * View the form
         */

        $g->html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'loginform.php';
    }
}