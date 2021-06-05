<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPToDoList';


        $show_poof = true;


        $app_state->html_title = 'Task List';


        $app_state->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}