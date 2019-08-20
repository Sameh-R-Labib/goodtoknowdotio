<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/26/18
 * Time: 11:08 PM
 */

namespace GoodToKnow\Controllers;


class DefaultCommunity
{
    function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $special_community_array;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Default Community';

        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}