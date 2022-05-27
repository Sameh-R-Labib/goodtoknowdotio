<?php

namespace GoodToKnow\Controllers;

class move_a_post_instruct
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Instruction';

        require VIEWS . DIRSEP . 'moveapostinstruct.php';
    }
}