<?php

use GoodToKnow\Models\taxable_income_event;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


/**
 * 1) Validate the submitted year_received.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$g->tax_year = integer_form_field_prep('year_received', 1992, 65535);


/**
 * 2) Present the taxable_income_event(s/plural) which fall in that year.
 */

$sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $g->db->real_escape_string((string)$g->tax_year);
$sql .= ' AND `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

$g->array = taxable_income_event::find_by_sql($sql);

if (!$g->array) {

    breakout(" For <b>$g->tax_year</b> I could NOT find any taxable income events. ");

}