<?php

namespace GoodToKnow\Controllers;

class DefaultCommunity
{
    function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $special_community_array;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'Default Community';

        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}