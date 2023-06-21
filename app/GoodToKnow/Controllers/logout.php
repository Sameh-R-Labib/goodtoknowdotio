<?php

namespace GoodToKnow\Controllers;

class logout
{
    function page()
    {
        /**
         * The purpose is to destroy the session file
         * then redirect to the login page.
         */

        global $g;

        // Although /ax1/login_form/page will also clear the session I will clear it here too!
        $_SESSION = [];
        session_destroy();

        // We are telling redirect_to() not to store the message in the session.
        $g->store_message = false;
        redirect_to("/ax1/login_form/page");
    }
}