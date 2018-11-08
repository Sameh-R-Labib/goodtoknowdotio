<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/2/18
 * Time: 9:36 PM
 */

namespace GoodToKnow\Controllers;


class WriteToAdmin
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $user_username;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $admin_username = ADMINUSERNAME;

        /**
         * Display the editor interface.
         */
        $html_title = 'Write to Admin';

        $pre_populate = <<<ROI
Dear Admin {$admin_username},

I would like you to add a particular topic to a particular community.

Sincerely,

{$user_username}


ROI;

        require VIEWS . DIRSEP . 'writetoadmin.php';
    }
}