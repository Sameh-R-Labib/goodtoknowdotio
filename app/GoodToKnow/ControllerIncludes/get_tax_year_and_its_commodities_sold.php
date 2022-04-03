<?php

use GoodToKnow\Models\commodity_sold;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


/**
 *  1) Validate the submitted tax_year.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$g->tax_year = integer_form_field_prep('tax_year', 1992, 65535);


/**
 * 2) Present the commodity_sold(s/plural) which fall in that year as radio buttons.
 */

$sql = 'SELECT * FROM `commodities_sold` WHERE `tax_year` = ' . $g->db->real_escape_string($g->tax_year);
$sql .= ' AND `user_id` = ' . $g->db->real_escape_string($g->user_id);

$g->array = commodity_sold::find_by_sql($sql);

if (!$g->array) {

    breakout(" For <b>$g->tax_year</b> I could NOT find any commodity_sold(s/plural) ¯\_(ツ)_/¯. ");

}
