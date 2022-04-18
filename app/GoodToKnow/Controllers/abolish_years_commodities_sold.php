<?php

namespace GoodToKnow\Controllers;

class abolish_years_commodities_sold
{
    function page()
    {
        /**
         * Note: It's an Admin script.
         */

        global $g;

        kick_out_nonadmins_or_if_there_is_error_msg();

        $g->html_title = 'Which year?';

        require VIEWS . DIRSEP . 'abolishyearscommoditiessold.php';
    }
}