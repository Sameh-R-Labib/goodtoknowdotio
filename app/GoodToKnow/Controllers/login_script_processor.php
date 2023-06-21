<?php

namespace GoodToKnow\Controllers;

class login_script_processor
{
    function page()
    {
        global $g;


        /**
         * Make sure that a form was submitted.
         */

        if (empty($_POST) || !is_array($_POST)) {

            breakout(' Unexpected deficiencies in the _POST array. ');

        }

        if ($_POST['choice'] === 'agree') {

            $_SESSION['agree_to_tos'] = 'agree';
            breakout(' Welcome back! ');

        } else {

            $g->message .= " You can't use this app because you did not agree to the TOS. ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }
    }
}