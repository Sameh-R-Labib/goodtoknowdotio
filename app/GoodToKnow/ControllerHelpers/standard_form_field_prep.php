<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param int $min_length
 * @param int $max_length
 * @return string
 */
function standard_form_field_prep(string $field_name, int $min_length, int $max_length): string
{
    /**
     * Warning: Since this will apply htmlspecialchars() then it is not appropriate to
     * use this for submitted markdown. The markdown parser will (if desired) convert html
     * special characters while it produces the html.
     */

    /**
     * Note: This is for data which will remain as a string value in the function's calling scope.
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
     * If the post value is an empty string and $min_length is 0
     * then an empty string is returned by the function.
     *
     * How does it prep the data?
     * - It makes sure the string exists.
     * - It makes sure the string is trimmed.
     * - It makes sure the string is not too short.
     * - It makes sure the string is not too long.
     * - It applies htmlspecialchars.
     */


    // If the post var is not set.

    if (!isset($_POST[$field_name])) {

        breakout(" The value for {$field_name} is missing. ");

    }


    // Initialize the string we will be returning.

    $string_for_return = $_POST[$field_name];


    // Trim.

    $string_for_return = trim($string_for_return);


    // Make sure the string is not too short.

    if (strlen($string_for_return) < $min_length) {

        breakout(" The string value for {$field_name} is too short. ");

    }


    // Make sure the string is not too long.

    if (strlen($string_for_return) > $max_length) {

        breakout(" The string value for {$field_name} is too long. ");

    }


    // Apply htmlspecialchars.

    $string_for_return = htmlspecialchars($string_for_return, ENT_NOQUOTES | ENT_HTML5);


    // Return.

    return $string_for_return;
}