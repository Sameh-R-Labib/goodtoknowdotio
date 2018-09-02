<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/26/18
 * Time: 9:12 AM
 */

namespace GoodToKnow\Controllers;


class LoginForm
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if ($is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'loginform.php';
    }
}