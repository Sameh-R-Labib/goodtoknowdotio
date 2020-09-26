<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;
        global $show_poof;

        kick_out_loggedoutusers();

        $page = 'CPCrypto';

        $show_poof = true;

        $html_title = 'Crypto';

        $sessionMessage .= ' Manage crypto. ';

        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}