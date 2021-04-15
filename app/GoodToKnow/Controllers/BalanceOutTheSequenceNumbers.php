<?php


namespace GoodToKnow\Controllers;


class BalanceOutTheSequenceNumbers
{
    function page()
    {
        global $html_title;
        global $is_admin;
        global $is_logged_in;
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;
        global $special_topic_array;
        global $special_post_array;

        kick_out_nonadmins();

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}