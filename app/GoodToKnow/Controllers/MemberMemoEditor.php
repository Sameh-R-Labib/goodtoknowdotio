<?php

namespace GoodToKnow\Controllers;

class MemberMemoEditor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Collect the username.
         */

        $html_title = "Member's Memo Editor";

        require VIEWS . DIRSEP . 'membermemoeditor.php';
    }
}