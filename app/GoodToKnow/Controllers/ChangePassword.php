<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/27/18
 * Time: 4:39 PM
 */

namespace GoodToKnow\Controllers;


class ChangePassword
{
    public function page()
    {
        /**
         * We will display a form where the user
         * enters their current password and the
         * new password. The new password must
         * be entered twice.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Change Password';

        require VIEWS . DIRSEP . 'changepassword.php';
    }
}