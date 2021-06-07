<?php

namespace GoodToKnow\Controllers;

class MemberMemoEditor
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $g->html_title = "Member's Memo Editor";

        require VIEWS . DIRSEP . 'membermemoeditor.php';
    }
}