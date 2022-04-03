<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\user;

/**
 * @param string $username
 * @return bool
 */
function is_username_syntactandexists(string &$username): bool
{
    global $g;

    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($username)) {

        $g->message .= " The username field was empty. ";

        return false;
    }

    $is_in_use = user::is_taken_username($username);

    if (!$is_in_use) {

        $g->message .= " The username could not be found. ";

        return false;
    }

    return true;
}