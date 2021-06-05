<?php

namespace GoodToKnow\Controllers;

class DropACommoditySold
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a CommoditySold.
         *
         * This page is going to present a text box for entering a tax_year to be used to narrow down the choices
         * for which CommoditySold to delete.
         */


        global $app_state;


        kick_out_loggedoutusers();


        $app_state->html_title = 'Which tax year?';


        require VIEWS . DIRSEP . 'dropacommoditysold.php';
    }
}