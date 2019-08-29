<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @return string
 */
function before_after_form_field_prep(string $field_name): string
{
    /**
     * This returns either the string 'before' or 'after' depending on the content of the $_POST array element whose key is
     * $field_name. Otherwise, it breaks out to the home page with an error message if something went wrong.
     */

    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $choice = standard_form_field_prep($field_name, 5, 6);

    if (is_null($choice)) {

        breakout(' The before/after choice you entered did not pass validation. ');

    }

    if ($choice !== "before" && $choice !== "after") {

        breakout(' You didn\'t enter a before/after choice. ');

    }

    return $choice;
}