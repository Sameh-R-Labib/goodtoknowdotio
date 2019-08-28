<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param float $min_value
 * @param float $max_value
 * @return float|null
 */
function float_form_field_prep(string $field_name, float $min_value, float $max_value): ?float
{
    // If the $_POST[$field_name] var is not set then return null.

    if (!isset($_POST[$field_name])) {

        return null;

    }


    // Initialize the float variable which is for return value.

    $float_for_return = $_POST[$field_name];


    // Trim.

    $float_for_return = trim($float_for_return);


    // Make sure we have a number in the string.

    if (!is_numeric($float_for_return)) {

        return null;

    }


    // Convert the string to an float.

    $float_for_return = (float)$float_for_return;


    // Makes sure the int is in range.

    if ($float_for_return < $min_value || $float_for_return > $max_value) {

        return null;

    }


    // Return.

    return $float_for_return;
}