<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPCrypto';


        $show_poof = true;


        $app_state->html_title = 'Crypto';


        $app_state->message .= ' Manage crypto. ';


        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}