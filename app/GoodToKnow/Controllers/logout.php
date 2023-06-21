<?php

namespace GoodToKnow\Controllers;

class logout
{
    function page()
    {
        /**
         * The reason we have this route in spite of the fact that
         * we also have a route named login_form is that this route
         * is for direct links in the view. It makes it unnecessary
         * to put business logic in the view. Most notably the
         * logout button loads this route.
         */

        global $g;

        $g->is_logged_in = false;
        $_SESSION['is_logged_in'] = $g->is_logged_in;
        reset_feature_session_vars();
        redirect_to("/ax1/login_form/page");
    }
}