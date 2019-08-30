<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param int $min_value
 * @param int $max_value
 * @return int
 */
function integer_form_field_prep(string $field_name, int $min_value, int $max_value): int
{
    /**
     * Note: This is for data which will be an integer value in the function's calling scope.
     *
     * This function will take the post value for the $field_name
     * and it will prep it and return the result to be assigned
     * to a variable in the function's calling scope.
     *
     * If
     * A) the post value is not set
     * B) or if it fails validation
     * then it breaks out.
     *
     * How does it prep the data?
     * - It makes sure the variable for the string is set.
     * - It makes sure the string is trimmed.
     * - It makes sure the string contains a number.
     * - It converts the string to an int.
     * - It makes sure the int is in range.
     */


    // If the $_POST[$field_name] var is not set then return null.

    if (!isset($_POST[$field_name])) {

        breakout(" The value for {$field_name} is missing. ");

    }


    // Initialize the int variable which is for return value.

    $int_for_return = $_POST[$field_name];


    // Trim.

    $int_for_return = trim($int_for_return);


    // Make sure we have a number in the string.

    if (!is_numeric($int_for_return)) {

        breakout(" The value for {$field_name} is not numeric. ");

    }


    // Convert the string to an int.

    $int_for_return = (int)$int_for_return;


    // Makes sure the int is in range.

    if ($int_for_return < $min_value || $int_for_return > $max_value) {

        breakout(" The value for {$field_name} is out of range. ");

    }


    // Return.

    return $int_for_return;
}