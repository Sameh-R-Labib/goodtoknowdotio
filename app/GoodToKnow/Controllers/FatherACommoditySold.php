<?php

namespace GoodToKnow\Controllers;

class FatherACommoditySold
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the commodities_sold table.
         */

        global $sessionMessage;

        global $timezone;

        kick_out_loggedoutusers();

        $html_title = 'Create a Commodity Sold';

        require VIEWS . DIRSEP . 'fatheracommoditysold.php';
    }
}