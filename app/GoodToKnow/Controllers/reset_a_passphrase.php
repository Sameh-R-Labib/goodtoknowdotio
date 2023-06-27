<?php

namespace GoodToKnow\Controllers;

class reset_a_passphrase
{
    function page()
    {
        /**
         * This feature enables admin to set a new passphrase for the user.
         *
         * Q: Why would admin do such a thing?
         * A: Because the user forgot his passphrase.
         */


        global $g;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $g->html_title = "Reset A User's Passphrase";

        require VIEWS . DIRSEP . 'resetapassphrase.php';
    }
}