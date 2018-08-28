<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 10:01 PM
 */

namespace GoodToKnow\Controllers;


class AdminPassCodeGenerationForm
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin) {
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'Admin Pass-Code Generation Form';

        require VIEWS . DIRSEP . 'adminpasscodegenerationform.php';
    }
}