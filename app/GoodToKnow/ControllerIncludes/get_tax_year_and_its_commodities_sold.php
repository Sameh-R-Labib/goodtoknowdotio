<?php

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $gtk;
global $db;
global $tax_year;


kick_out_loggedoutusers();


/**
 *  1) Validate the submitted tax_year.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$tax_year = integer_form_field_prep('tax_year', 1992, 65535);


/**
 * 2) Present the CommoditySold(s/plural) which fall in that year as radio buttons.
 */

$db = get_db();

$sql = 'SELECT * FROM `commodities_sold` WHERE `tax_year` = ' . $db->real_escape_string($tax_year);
$sql .= ' AND `user_id` = ' . $db->real_escape_string($gtk->user_id);

$gtk->array = CommoditySold::find_by_sql($sql);

if (!$gtk->array || !empty($gtk->message)) {

    breakout(" For <b>{$tax_year}</b> I could NOT find any CommoditySold(s/plural) ¯\_(ツ)_/¯. ");

}
