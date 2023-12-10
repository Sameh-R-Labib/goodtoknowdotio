<?php

namespace GoodToKnow\Controllers;

class spy_commodities_sold_year_filter
{
    function page()
    {
        /**
         * 1) Validate the submitted tax_year.
         * 2) Present the commodity_sold(s/plural) in a page whose layout is similar to the home page.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';


        require CONTROLLERINCLUDES . DIRSEP . 'prep_commodities_sold_for_viewing.php';


        /**
         * Prep the view.
         */

        $g->html_title = "One year's commodities sold records";

        $g->page = 'spy_commodities_sold_year_filter';

        $g->show_poof = true;

        $g->message .= " Here's one year of Capital Gain. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'spycommoditiessoldyearfilter.php';
    }
}