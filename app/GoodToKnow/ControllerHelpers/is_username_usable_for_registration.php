<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\User;
use mysqli;

/**
 * @param string $username
 * @return bool
 */
function is_username_usable_for_registration(string &$username): bool
{
    global $db;
    global $sessionMessage;

    require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';

    if (!is_username_syntactically($username)) {

        $sessionMessage .= " The username field failed validation due to its lack of conformity. ";

        return false;
    }

    $is_in_use = User::is_taken_username($db, $username);

    if ($is_in_use) {

        $sessionMessage .= " The username is taken. Find a different one and try again. ";

        return false;
    }

    return true;
}