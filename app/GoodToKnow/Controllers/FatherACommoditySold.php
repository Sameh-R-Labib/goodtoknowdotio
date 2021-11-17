<?php

namespace GoodToKnow\Controllers;

class FatherACommoditySold
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the commodities_sold table.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a Commodity Sold';


        require VIEWS . DIRSEP . 'fatheracommoditysold.php';
    }
}