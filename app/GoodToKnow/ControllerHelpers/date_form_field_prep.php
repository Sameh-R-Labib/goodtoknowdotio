<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @return string
 */
function date_form_field_prep(string $field_name): string
{
    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $submitted_date = standard_form_field_prep($field_name, 10, 14);

    require_once CONTROLLERHELPERS . DIRSEP . 'is_date.php';

    if (!is_date($submitted_date)) {

        breakout(' This date value is invalid. ');

    }

    return $submitted_date;
}