<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\User;

/**
 * @param string $username
 * @return bool
 */
function is_username_syntactandexists(string &$username): bool
{
    global $db;
    global $sessionMessage;

    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($username)) {

        $sessionMessage .= " The username field was empty. ";

        return false;
    }

    $is_in_use = User::is_taken_username($username);

    if (!$is_in_use) {

        $sessionMessage .= " The username could not be found. ";

        return false;
    }

    return true;
}