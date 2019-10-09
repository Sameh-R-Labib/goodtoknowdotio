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

        kick_out_loggedoutusers();

        $page = 'CPCapitalGains';

        $show_poof = true;

        $html_title = 'Capital Gains';

        $sessionMessage .= ' Managing capital gains. ';

        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}