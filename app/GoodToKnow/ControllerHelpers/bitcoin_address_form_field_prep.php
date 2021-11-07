<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @return string
 */
function bitcoin_address_form_field_prep(string $field_name): string
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

    $string_for_return = $_POST[$field_name];

    $string_for_return = trim($string_for_return);


    /**
     * I need to make sure the address doesn't have any html special characters.
     */

    $found = false;

    $array_of_html_chars = ['&', '"', '\'', '<', '>'];

    $array = str_split($string_for_return);

    foreach ($array as $char) {

        if (in_array($char, $array_of_html_chars)) {

            $found = true;
            break;
        }
    }

    if ($found) {

        breakout(' I can\'t use this address because it has an HTML special character. ');

    }

    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    return standard_form_field_prep($field_name, 2, 264);

}