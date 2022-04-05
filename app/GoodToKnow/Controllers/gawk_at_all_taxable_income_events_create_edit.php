<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\taxable_income_event;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class gawk_at_all_taxable_income_events_create_edit
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();

        $sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $g->db->real_escape_string((string)$g->saved_int02);
        $sql .= ' AND `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

        $g->array = taxable_income_event::find_by_sql($sql);

        if (!$g->array) {

            breakout(" For <b>$g->saved_int02</b> I could NOT find any taxable income events. ");

        }


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        foreach ($g->array as $item) {

            $item->time = get_readable_time($item->time);

            $item->comment = nl2br($item->comment, false);

            $item->amount = readable_amount_of_money($item->currency, $item->amount);

            $item->price = readable_amount_of_money($item->fiat, $item->price);

        }


        $g->html_title = "One year of your taxable income events";


        $g->page = 'gawk_at_all_taxable_income_events';


        $g->show_poof = true;


        $g->tax_year = $g->saved_int02;


        /**
         * This is similar to doing a breakout but there is no redirect,
         * and it does not present the home page itself.
         */

        $g->message .= " Here are <b>$g->saved_int02</b>'s taxable income events. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'gawkatalltaxableincomeeventsyearfilter.php';

    }
}