<?php


namespace GoodToKnow\Controllers;


class clear_session_vars
{
    function page(string $last_controller = '')
    {
        global $g;


        /**
         * We are doing this so that breakout will
         * redirect to the most convenient route
         * for the user after he clicks on Abort.
         *
         * Under normal circumstances $g->controller_name
         * would already be the last controller.
         */
        if (!empty($last_controller)) {
            $g->controller_name = $last_controller;
        }


        breakout(" You aborted! ");
    }
}