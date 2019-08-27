<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\User;
use mysqli;

/**
 * @param mysqli $db
 * @param string $message
 * @param string $username
 * @return bool
 */
function is_username_syntactandexists(mysqli $db, string &$message, string &$username): bool
{
    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($message, $username)) {

        $message .= " The username field was empty. ";

        return false;
    }

    $is_in_use = User::is_taken_username($db, $message, $username);

    if (!$is_in_use) {

        $message .= " The username could not be found. ";

        return false;
    }

    return true;
}