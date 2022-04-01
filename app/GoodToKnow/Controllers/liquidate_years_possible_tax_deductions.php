<?php

namespace GoodToKnow\Controllers;

class liquidate_years_possible_tax_deductions
{
    function page()
    {
        /**
         * Admin script.
         */

        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}