<?php

use function GoodToKnow\ControllerHelpers\commodity_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


global $g;
// $g->saved_int01 commodities_sold id


/**
 * 1) Validate the submitted form data. (and apply htmlspecialchars)
 */

require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'commodity_address_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';


/**
 * Get the $g->time_bought and $g->time_sold (which are timestamps) based on submitted:
 * `timezone` `time_bought_date` `time_bought_hour` `time_bought_minute` `time_bought_second`
 * `time_sold_date` `time_sold_hour` `time_sold_minute` `time_sold_second`
 */


require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_bought_and_time_sold_epochs.php';


/**
 * Get $g->price_bought
 */

$g->price_bought = float_form_field_prep('price_bought', 0.0, 999999999999999.99);


/**
 * Get $g->price_sold
 */

$g->price_sold = float_form_field_prep('price_sold', 0.0, 999999999999999.99);


/**
 * Get $g->currency_transacted
 */

$g->currency_transacted = standard_form_field_prep('currency_transacted', 1, 15);


/**
 * Get $g->commodity_amount
 */

$g->commodity_amount = float_form_field_prep('commodity_amount', 0.0, 999999999999999.99);


/**
 * Get $g->commodity_type
 */

$g->commodity_type = standard_form_field_prep('commodity_type', 1, 15);


/**
 * Get $g->commodity_label
 *
 * Most typically this is a bitcoin address. But, it can be a commodity address / label.
 */

$g->commodity_label = commodity_address_form_field_prep('commodity_label');


/**
 * Get $g->tax_year
 */

$g->tax_year = integer_form_field_prep('tax_year', 1992, 65535);


/**
 * Get $g->profit
 */

$g->profit = float_form_field_prep('profit', 0.0, 999999999999999.99);
