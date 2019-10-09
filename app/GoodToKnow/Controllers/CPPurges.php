<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $page = 'CPPurges';

        $show_poof = true;

        $html_title = 'Purges';

        $sessionMessage .= ' Managing purges. ';

        require VIEWS . DIRSEP . 'cppurges.php';
    }
}