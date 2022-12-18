<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class process_a_commodity_sale_form_processor
{
    function page()
    {


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Read and store the submitted data.
         */

        // Get commodity. This is the type of commodity which got sold.
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        $commodity = standard_form_field_prep('commodity', 1, 15);

        // Get amount. This is the amount of commodity sold.
        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';
        $amount = float_form_field_prep('amount', -0.0000000000000001, 99999999999999.99);

        // Get time. This is the time when the commodity was sold.
        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        $time = (int)$g->time;
        // - - -

        // Get tax_year. This is the tax year in which the commodity was sole.
        $tax_year = integer_form_field_prep('tax_year', 1992, 65535);

        // Get currency. This is the currency used to price the commodity.
        $currency = standard_form_field_prep('currency', 1, 15);

        // Get price_sold. This is the price of a unit of the commodity at the time of sale.
        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
        $price_sold = float_form_field_prep('price_sold', -0.0000000000000001, 99999999999999.99);

        // Get reason. This is the reason for selling.
        // Which looks like: "for moving BTC on the blockchain."
        $reason = standard_form_field_prep('reason', 3, 54);

        // Store the submitted data in the session.
        $_SESSION['saved_arr01']['commodity'] = $commodity;
        $_SESSION['saved_arr01']['amount'] = $amount;
        $_SESSION['saved_arr01']['time'] = $time;
        $_SESSION['saved_arr01']['tax_year'] = $tax_year;
        $_SESSION['saved_arr01']['currency'] = $currency;
        $_SESSION['saved_arr01']['price_sold'] = $price_sold;
        $_SESSION['saved_arr01']['reason'] = $reason;

        // Redirect because we've done enough here.
        redirect_to("/ax1/process_a_commodity_sale_generate_changes/page");
    }
}