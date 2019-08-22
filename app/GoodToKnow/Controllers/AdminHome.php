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
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;

        if (!$is_logged_in OR !$is_admin) {
            breakout('');
        }

        $html_title = 'Admin';

        $page = 'Admin';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}