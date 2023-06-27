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


        kick_out_nonadmins();


        $g->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}