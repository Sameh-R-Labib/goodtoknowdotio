<?php

namespace GoodToKnow\Controllers;

class RemoveCommunitiesFromAUser
{
    function page()
    {
        global $html_title;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}