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
         * 1. Read and store the submitted data.
         */

        // Get commodity. This is the type of commodity which got sold.
        $commodity = standard_form_field_prep('commodity', 1, 15);

        // Get amount. This is the amount of commodity sold.
        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
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

        // Get
    }
}