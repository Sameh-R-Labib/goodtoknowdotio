<?php

namespace GoodToKnow\Controllers;

class SpyCommoditiesSold
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a tax_year value to be used
         * so that the subsequent code can display the commodities_sold(s/plural) for that year.
         */


        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'spycommoditiessold.php';
    }
}