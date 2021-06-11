<?php

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


kick_out_loggedoutusers();


/**
 *  1) Validate the submitted tax_year.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$g->tax_year = integer_form_field_prep('tax_year', 1992, 65535);


/**
 * 2) Present the CommoditySold(s/plural) which fall in that year as radio buttons.
 */

get_db();

$sql = 'SELECT * FROM `commodities_sold` WHERE `tax_year` = ' . $g->db->real_escape_string($g->tax_year);
$sql .= ' AND `user_id` = ' . $g->db->real_escape_string($g->user_id);

$g->array = CommoditySold::find_by_sql($sql);

if (!$g->array || !empty($g->message)) {

    breakout(" For <b>{$g->tax_year}</b> I could NOT find any CommoditySold(s/plural) ¯\_(ツ)_/¯. ");

}
