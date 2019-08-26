<?php

namespace GoodToKnow\Controllers;

class GiveCommunitiesToUser
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Collect the username.
         */

        $html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}