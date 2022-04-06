<?php

namespace GoodToKnow\Controllers;

class login_script_processor
{
    function page()
    {
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

            redirect_to("/ax1/logout/page");

        }
    }
}