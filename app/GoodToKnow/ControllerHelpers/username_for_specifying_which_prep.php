<?php

namespace GoodToKnow\ControllerHelpers;

use mysqli;

/**
 * @param mysqli $db
 * @return string
 */
function username_for_specifying_which_prep(mysqli $db): string
{
    /**
     * Get the submitted username. It is assumed that this username is being submitted solely to identify an account.
     *
     * So what are we checking it for?
     * 1) The standard text field with string length limits.
     * 2) If it fits the requirements for what a GTK.io username should look like.
     * 3) If it represents a user account.
     */


    require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

    $submitted_username = standard_form_field_prep('username', 7, 12);


    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactandexists.php';

    if (!is_username_syntactandexists($db, $submitted_username)) {

        breakout(' The username field failed validation. ');

    }

    return $submitted_username;
}