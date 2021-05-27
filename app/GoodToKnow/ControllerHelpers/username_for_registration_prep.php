<?php

namespace GoodToKnow\ControllerHelpers;

use mysqli;

/**
 * @param mysqli $db
 * @return string
 */
function username_for_registration_prep(mysqli $db): string
{
    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $submitted_username = standard_form_field_prep('username', 7, 12);

    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_usable_for_registration.php';

    if (!is_username_usable_for_registration($db, $submitted_username)) {

        breakout(' This username value is invalid. ');

    }

    return $submitted_username;
}