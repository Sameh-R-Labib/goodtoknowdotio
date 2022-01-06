<?php

use GoodToKnow\Models\PossibleTaxDeduction;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


/**
 *  1) Validate the submitted year_paid.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$year_paid = integer_form_field_prep('year_paid', 1992, 65535);


/**
 * 2) Present the PossibleTaxDeduction(s/plural) which fall in that year as radio buttons.
 */

$sql = 'SELECT * FROM `possible_tax_deduction` WHERE `year_paid` = ' . $g->db->real_escape_string($year_paid);
$sql .= ' AND `user_id` = ' . $g->db->real_escape_string($g->user_id);

$g->array = PossibleTaxDeduction::find_by_sql($sql);

if (!$g->array || !empty($g->message)) {

    breakout(" For <b>{$year_paid}</b> I could NOT find any Possible Tax Deductions. ");

}
