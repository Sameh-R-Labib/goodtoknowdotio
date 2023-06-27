<?php

namespace GoodToKnow\Controllers;

class c_p_to_do_list
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_to_do_list';


        $g->show_poof = true;


        $g->html_title = 'Task List';


        $g->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}