<?php

namespace GoodToKnow\Controllers;

class LoginForm
{
    function page()
    {
        global $gtk;


        if ($gtk->is_logged_in) {

            $_SESSION['message'] = $gtk->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }


        $gtk->html_title = 'GoodToKnow.io';


        require VIEWS . DIRSEP . 'loginform.php';
    }
}