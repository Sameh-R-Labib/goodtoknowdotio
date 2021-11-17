<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'CPCrypto';


        $g->show_poof = true;


        $g->html_title = 'Crypto';


        $g->message .= ' Manage crypto. ';


        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}