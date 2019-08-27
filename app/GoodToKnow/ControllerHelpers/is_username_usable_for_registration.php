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
function is_username_usable_for_registration(mysqli $db, string &$message, string &$username): bool
{
    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($message, $username)) {

        $message .= " The username field was empty. ";

        return false;
    }

    $is_in_use = User::is_taken_username($db, $message, $username);

    if ($is_in_use) {

        $message .= " The username is taken. Find a different one and try again. ";

        return false;
    }

    return true;
}