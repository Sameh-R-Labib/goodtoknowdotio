<?php

namespace GoodToKnow\Controllers;

class member_memo_editor
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Collect the username.
         */

        $g->html_title = "Member's Memo Editor";

        require VIEWS . DIRSEP . 'membermemoeditor.php';
    }
}