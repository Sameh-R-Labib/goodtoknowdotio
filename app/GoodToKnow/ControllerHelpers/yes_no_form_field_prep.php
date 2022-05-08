<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @return string
 */
function yes_no_form_field_prep(string $field_name): string
{
    /**
     * This returns either the string 'yes' or 'no' depending on the content of the $_POST array element whose key is
     * $field_name. Otherwise, it breaks out to the home page with an error message if something went wrong.
     */

    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $choice = standard_form_field_prep($field_name, 2, 3);

    if ($choice != "yes" && $choice != "no") {

        breakout(' You did not enter a yes/no choice. ');

    }

    return $choice;
}