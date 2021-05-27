<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\User;
use mysqli;

/**
 * @param mysqli $db
 * @param string $username
 * @return bool
 */
function is_username_syntactandexists(mysqli $db, string &$username): bool
{
    global $sessionMessage;

    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($sessionMessage, $username)) {

        $sessionMessage .= " The username field was empty. ";

        return false;
    }

    $is_in_use = User::is_taken_username($db, $username);

    if (!$is_in_use) {

        $sessionMessage .= " The username could not be found. ";

        return false;
    }

    return true;
}