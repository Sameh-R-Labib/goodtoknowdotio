<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 6:23 PM
 */

namespace GoodToKnow\Controllers;


class AdminHome
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin) {
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'Admin';

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}