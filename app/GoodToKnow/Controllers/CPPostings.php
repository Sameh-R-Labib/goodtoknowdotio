<?php

namespace GoodToKnow\Controllers;

class CPPostings
{
    function page()
    {
        global $sessionMessage;
        global $html_title;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_logged_in;
        global $is_guest;
        global $show_poof;

        kick_out_nonadmins();

        $page = 'CPPostings';

        $show_poof = true;

        $html_title = 'Postings';

        $sessionMessage .= ' Manage postings. ';

        require VIEWS . DIRSEP . 'cppostings.php';
    }
}