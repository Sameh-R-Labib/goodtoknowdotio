<?php

namespace GoodToKnow\Controllers;

class c_p_changed_content
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->page = 'c_p_changed_content';


        $g->show_poof = true;


        $g->html_title = 'Changed Content';


        $g->message .= " Monitor blog's changed content and delete troublesome uploads. ";


        require VIEWS . DIRSEP . 'cpchangedcontent.php';
    }
}