<?php

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $gtk;
global $db;


kick_out_loggedoutusers();


/**
 * 1) Validate the submitted year_received.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$year_received = integer_form_field_prep('year_received', 1992, 65535);


/**
 * 2) Present the TaxableIncomeEvent(s/plural) which fall in that year.
 */

$db = get_db();

$sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $db->real_escape_string($year_received);
$sql .= ' AND `user_id` = ' . $db->real_escape_string($gtk->user_id);

$gtk->array = TaxableIncomeEvent::find_by_sql($sql);

if (!$gtk->array || !empty($gtk->message)) {

    breakout(" For <b>{$year_received}</b> I could NOT find any taxable income. ");

}