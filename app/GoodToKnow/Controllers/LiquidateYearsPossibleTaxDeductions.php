<?php

namespace GoodToKnow\Controllers;

class LiquidateYearsPossibleTaxDeductions
{
    function page()
    {
        /**
         * Admin script.
         */

        global $gtk;


        kick_out_nonadmins();


        $gtk->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}