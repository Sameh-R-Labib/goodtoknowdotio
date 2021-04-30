<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $sessionMessage;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPCrypto';


        $show_poof = true;


        $html_title = 'Crypto';


        $sessionMessage .= ' Manage crypto. ';


        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}