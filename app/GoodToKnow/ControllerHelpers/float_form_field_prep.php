<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param float $min_value
 * @param float $max_value
 * @return float
 */
function float_form_field_prep(string $field_name, float $min_value, float $max_value): float
{
    /**
     * Make sure that a form was submitted.
     */

    if (empty($_POST) || !is_array($_POST)) {

        breakout(' Unexpected deficiencies in the _POST array. ');

    }


    if (!isset($_POST[$field_name])) {

        breakout(" The value for {$field_name} is missing. ");

    }


    // Initialize the float variable which is for return value.

    $float_for_return = $_POST[$field_name];


    // Trim.

    $float_for_return = trim($float_for_return);


    // Make sure we have a number in the string.

    if (!is_numeric($float_for_return)) {

        breakout(" The value for {$field_name} is not a numeric. ");

    }


    // Convert the string to a float.

    $float_for_return = (float)$float_for_return;


    // Makes sure the float is in range.

    if ($float_for_return < $min_value || $float_for_return > $max_value) {

        breakout(" The value for {$field_name} is out of range. ");

    }


    // Return.

    return $float_for_return;
}