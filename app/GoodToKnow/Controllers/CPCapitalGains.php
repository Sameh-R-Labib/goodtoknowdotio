<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;
        global $page;
        global $show_poof;
        global $html_title;

        kick_out_loggedoutusers();

        $page = 'CPCapitalGains';

        $show_poof = true;

        $html_title = 'Capital Gains';

        $sessionMessage .= ' Manage capital gains. ';

        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}