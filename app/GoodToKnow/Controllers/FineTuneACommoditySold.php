<?php

namespace GoodToKnow\Controllers;

class FineTuneACommoditySold
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a tax_year value to be used
         * to narrow down the choices for which CommoditySold to edit.
         */


        global $app_state;


        kick_out_loggedoutusers();


        $app_state->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'finetuneacommoditysold.php';
    }
}