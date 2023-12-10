<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity_sold;

class spy_commodities_sold_create_edit
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();


        $sql = 'SELECT * FROM `commodities_sold` WHERE `tax_year` = ' . $g->db->real_escape_string((string)$g->saved_int02);
        $sql .= ' AND `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

        $g->array = commodity_sold::find_by_sql($sql);

        if (!$g->array) {

            breakout(" For <b>(string)$g->saved_int02</b> I could NOT find any commodity_sold(s/plural) ¯\_(ツ)_/¯. ");

        }


        require CONTROLLERINCLUDES . DIRSEP . 'prep_commodities_sold_for_viewing.php';


        /**
         * Prep the view.
         */

        $g->html_title = "$g->saved_int02's commodities sold records";

        $g->page = 'spy_commodities_sold_year_filter';

        $g->show_poof = true;

        $g->tax_year = $g->saved_int02;


        /**
         * This is similar to doing a breakout but there is no redirect,
         * and it does not present the home page itself.
         */

        $g->message .= " Here are <b>$g->saved_int02</b>'s Capital Gain. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'spycommoditiessoldyearfilter.php';
    }
}