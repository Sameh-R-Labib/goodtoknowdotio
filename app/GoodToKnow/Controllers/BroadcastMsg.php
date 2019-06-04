<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/14/18
 * Time: 1:33 AM
 */

namespace GoodToKnow\Controllers;


class BroadcastMsg
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_username;
        global $url_of_most_recent_upload;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Display the editor interface.
         */
        $html_title = 'Broadcast a Message';

        $pre_populate = <<<ROI
Dear Users,

[Broadcast to all]

Sincerely,

Admin {$user_username}


ROI;

        require VIEWS . DIRSEP . 'broadcastmsg.php';
    }
}