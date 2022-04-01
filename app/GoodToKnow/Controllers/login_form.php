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

            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/infinite_loop_prevent/page");

        }


        $g->html_title = 'GoodToKnow.io';


        require VIEWS . DIRSEP . 'loginform.php';
    }
}