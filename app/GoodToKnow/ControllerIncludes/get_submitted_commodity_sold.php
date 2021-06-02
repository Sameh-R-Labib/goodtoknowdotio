<?php

use function GoodToKnow\ControllerHelpers\bitcoin_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


global $user_id;
global $timezone;
global $app_state;
global $saved_int01;    // commodities_sold id
global $time_bought;
global $time_sold;
global $price_bought;
global $price_sold;
global $currency_transacted;
global $commodity_amount;
global $commodity_type;
global $commodity_label;
global $tax_year;
global $profit;

kick_out_loggedoutusers();


/**
 * 1) Validate the submitted finetuneacommoditysoldedit.php form data. (and apply htmlspecialchars)
 */

require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'bitcoin_address_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';


/**
 * Get the $time_bought and $time_sold (which are timestamps) based on submitted:
 * `timezone` `time_bought_date` `time_bought_hour` `time_bought_minute` `time_bought_second`
 * `time_sold_date` `time_sold_hour` `time_sold_minute` `time_sold_second`
 */


require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_bought_and_time_sold_epochs.php';


/**
 * Get $price_bought
 */

$price_bought = float_form_field_prep('price_bought', 0.0, 999999999999999.99);


/**
 * Get $price_sold
 */

$price_sold = float_form_field_prep('price_sold', 0.0, 999999999999999.99);


/**
 * Get $currency_transacted
 */

$currency_transacted = standard_form_field_prep('currency_transacted', 1, 15);


/**
 * Get $commodity_amount
 */

$commodity_amount = float_form_field_prep('commodity_amount', 0.0, 999999999999999.99);


/**
 * Get $commodity_type
 */

$commodity_type = standard_form_field_prep('commodity_type', 1, 15);


/**
 * Get $commodity_label
 *
 * Most typically this is a bitcoin address or something which can be perceived like it.
 */

$commodity_label = bitcoin_address_form_field_prep('commodity_label');


/**
 * Get $tax_year
 */

$tax_year = integer_form_field_prep('tax_year', 1992, 65535);


/**
 * Get $profit
 */

$profit = float_form_field_prep('profit', 0.0, 999999999999999.99);
