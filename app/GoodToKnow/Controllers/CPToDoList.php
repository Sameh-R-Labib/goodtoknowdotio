<?php

namespace GoodToKnow\Controllers;

class CPToDoList
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $page = 'CPToDoList';

        $show_poof = true;

        $html_title = 'To-do List';

        $sessionMessage .= ' Manage to-do list. ';

        require VIEWS . DIRSEP . 'cptodolist.php';
    }
}