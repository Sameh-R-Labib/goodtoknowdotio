<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPCrypto';


        $show_poof = true;


        $html_title = 'Crypto';


        $app_state->message .= ' Manage crypto. ';


        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}