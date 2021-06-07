<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $field_name
 * @return string
 */
function race_form_field_prep(string $field_name): string
{
    global $g;

    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $submitted_race = standard_form_field_prep($field_name, 3, 140);

    require_once CONTROLLERHELPERS . DIRSEP . 'is_race_inoursystem.php';

    if (!is_race_inoursystem($submitted_race)) {

        breakout(' This race value is invalid. ');

    }

    return $submitted_race;
}