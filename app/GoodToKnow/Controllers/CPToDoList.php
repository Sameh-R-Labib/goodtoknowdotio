<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPToDoList';


        $gtk->show_poof = true;


        $gtk->html_title = 'Task List';


        $gtk->message .= ' Manage to-do list. ';


        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}