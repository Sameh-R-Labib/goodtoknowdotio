<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPToDoList';


        $g->show_poof = true;


        $g->html_title = 'Task List';


        $g->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}