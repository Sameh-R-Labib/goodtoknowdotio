<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $sessionMessage;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPToDoList';


        $show_poof = true;


        $html_title = 'Task List';


        $sessionMessage .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}