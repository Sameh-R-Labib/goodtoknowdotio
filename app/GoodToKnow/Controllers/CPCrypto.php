<?php

namespace GoodToKnow\Controllers;

class CPCrypto
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPCrypto';


        $show_poof = true;


        $gtk->html_title = 'Crypto';


        $gtk->message .= ' Manage crypto. ';


        require VIEWS . DIRSEP . 'cpcrypto.php';
    }
}