<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity_sold;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

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


        /**
         * Loop through the array and replace attributes with more readable ones.
         *
         * Items which need this are:
         *   'time_bought', 'time_sold', 'price_bought', 'price_sold', 'commodity_amount', 'profit'.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        foreach ($g->array as $item) {

            $item->time_bought = get_readable_time($item->time_bought);
            $item->time_sold = get_readable_time($item->time_sold);
            $item->price_bought = readable_amount_of_money($item->currency_transacted, $item->price_bought);
            $item->price_sold = readable_amount_of_money($item->currency_transacted, $item->price_sold);
            $item->profit = readable_amount_of_money($item->currency_transacted, $item->profit);
            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

        }


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

        $g->message .= " Here are <b>$g->saved_int02</b>'s Commodity Sold. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'spycommoditiessoldyearfilter.php';
    }
}