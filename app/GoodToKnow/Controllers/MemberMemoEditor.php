<?php

namespace GoodToKnow\Controllers;

class MemberMemoEditor
{
    function page()
    {
        global $sessionMessage;
        global $html_title;

        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = "Member's Memo Editor";

        require VIEWS . DIRSEP . 'membermemoeditor.php';
    }
}