<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param int $min_length
 * @param int $max_length
 * @return string|null
 */
function standard_form_field_prep(string $field_name, int $min_length, int $max_length): ?string
{
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
     * then null will be returned.
     *
     * If the post value is an empty string and $min_length above is 0
     * then an empty string is returned by the function.
     *
     * How does it prep the data?
     * - It makes sure the string exists.
     * - It makes sure the string is trimmed.
     * - It makes sure the string is not too short.
     * - It makes sure the string is not too long.
     * - It applies htmlspecialchars.
     */

    // If the post var is not set then return null.
    if (!isset($_POST[$field_name])) {
        return null;
    }

    // Initialize the string we will be returning.
    $string_for_return = $_POST[$field_name];

    // Trim.
    $string_for_return = trim($string_for_return);

    // Make sure the string is not too short.
    if (strlen($string_for_return) < $min_length) {
        return null;
    }

    // Make sure the string is not too long.
    if (strlen($string_for_return) > $max_length) {
        return null;
    }

    // Apply htmlspecialchars.
    $string_for_return = htmlspecialchars($string_for_return, ENT_NOQUOTES | ENT_HTML5);

    // Return.
    return $string_for_return;
}