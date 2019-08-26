<?php

namespace GoodToKnow\Controllers;

class RemoveCommunitiesFromAUser
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}