<?php

namespace GoodToKnow\Controllers;

class spy_commodities_sold
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a tax_year value to be used
         * so that the subsequent code can display the commodities_sold(s/plural) for that year.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'spycommoditiessold.php';
    }
}