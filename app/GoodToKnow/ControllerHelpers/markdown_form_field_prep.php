<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @param int $min_length
 * @param int $max_length
 * @return string
 */
function markdown_form_field_prep(string $field_name, int $min_length, int $max_length): string
{
    /**
     * This is the same as standard_form_field_prep Except it does not apply htmlspecialchars().
     */


    /**
     * Make sure that a form was submitted.
     */

    if (empty($_POST) || !is_array($_POST)) {

        breakout(' Unexpected deficiencies in the _POST array. ');

    }


    // If the post var is not set.

    if (!isset($_POST[$field_name])) {

        breakout(" The value for {$field_name} is missing. ");

    }


    // Initialize the string we will be returning.

    $string_for_return = $_POST[$field_name];


    // Trim.

    $string_for_return = trim($string_for_return);


    // Add a newline character at the end so that GitHub won't say it is missing.
    // Additional newlines (beyond one newline) do no more good.

    $string_for_return .= "\n";


    // Make sure the string is not too short.

    if (strlen($string_for_return) < $min_length) {

        breakout(" The string value for {$field_name} is too short. ");

    }


    // Make sure the string is not too long.

    if (strlen($string_for_return) > $max_length) {

        breakout(" The string value for {$field_name} is too long. ");

    }


    // Return.

    return $string_for_return;
}