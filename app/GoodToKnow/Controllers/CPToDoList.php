<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPToDoList';


        $show_poof = true;


        $html_title = 'Task List';


        $app_state->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}