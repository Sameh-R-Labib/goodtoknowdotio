<?php

namespace GoodToKnow\Controllers;

class CPPostings
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $page = 'CPPostings';

        $show_poof = true;

        $html_title = 'Postings';

        $sessionMessage .= ' Manage postings. ';

        require VIEWS . DIRSEP . 'cppostings.php';
    }
}