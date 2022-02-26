<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\commodity_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class AddIncomeCommodityFormProcessor
{
    function page()
    {
        /**
         * Create two (2) database records. One in the taxable_income_event table and another in
         * the Commodity table.
         *
         * Also, there is a redo feature.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'commodity_address_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $label = commodity_address_form_field_prep('label');

        $year = integer_form_field_prep('year', 1992, 965535);

        $commodity = standard_form_field_prep('commodity', 1, 15);

        $amount = float_form_field_prep('amount', -0.0000000000000001, 99999999999999.99);

        $currency = standard_form_field_prep('currency', 1, 15);

        $price = float_form_field_prep('price', -0.0000000000000001, 99999999999999.99);

        $comment = standard_form_field_prep('comment', 0, 1800);
    }
}