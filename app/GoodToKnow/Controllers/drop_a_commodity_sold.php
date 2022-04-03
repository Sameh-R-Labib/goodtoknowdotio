<?php

namespace GoodToKnow\Controllers;

class drop_a_commodity_sold
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a commodity_sold.
         *
         * This page is going to present a text box for entering a tax_year to be used to narrow down the choices
         * for which commodity_sold to delete.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'dropacommoditysold.php';
    }
}