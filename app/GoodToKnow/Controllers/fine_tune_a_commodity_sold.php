<?php

namespace GoodToKnow\Controllers;

class fine_tune_a_commodity_sold
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a tax_year value to be used
         * to narrow down the choices for which CommoditySold to edit.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'finetuneacommoditysold.php';
    }
}