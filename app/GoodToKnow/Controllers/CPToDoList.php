<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPToDoList';


        $show_poof = true;


        $gtk->html_title = 'Task List';


        $gtk->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}