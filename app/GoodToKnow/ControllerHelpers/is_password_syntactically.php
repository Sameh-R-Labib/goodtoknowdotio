<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $password
 * @return bool
 */
function is_password_syntactically(string &$password): bool
{
    global $sessionMessage;

    /**
     * We want to help prevent sql injection
     */

    $trimmed = trim($password);

    if (empty($trimmed)) {

        $sessionMessage .= " The password field is required. ";

        return false;
    }


    /**
     * The length must be 10 to 264 characters long.
     */

    $length = strlen($password);

    if ($length > 264 || $length < 10) {

        $sessionMessage .= " The length of your password must be 10 to 264 characters. ";

        return false;
    }


    /**
     * It can't have a space character.
     */

    if (strpos($password, ' ')) {

        $sessionMessage .= " Non-conforming password because it contains space. ";

        return false;
    }


    /**
     * It can't have weird characters.
     */

    if (preg_match('/[\'$?<>=]/', $password)) {

        $sessionMessage .= " Non-conforming password because it contains one or more disallowed characters. ";

        return false;
    }

    /**
     * Strength of password
     */

    // count how many lowercase, uppercase, and digits are in the password

    $uc = 0;
    $lc = 0;
    $num = 0;
    $other = 0;

    for ($i = 0, $j = strlen($password); $i < $j; $i++) {

        // Get current character
        $char = substr($password, $i, 1);

        // if $char is uppercase
        if (preg_match('/^[[:upper:]]$/', $char)) {
            $uc++;
        } elseif (preg_match('/^[[:lower:]]$/', $char)) {
            // if $char is lowercase
            $lc++;
        } elseif (preg_match('/^[[:digit:]]$/', $char)) {
            // if $char is a numeric digit
            $num++;
        } else {
            $other++;
        }
    }

    $max = $j - 6;

    if ($uc > $max) {

        $sessionMessage .= " The password has too many upper case characters. ";

        return false;
    }

    if ($lc > $max) {

        $sessionMessage .= " The password has too many lower case characters. ";

        return false;
    }

    if ($num > $max) {

        $sessionMessage .= " The password has too many numeric characters. ";

        return false;
    }

    if ($num < 2) {

        $sessionMessage .= " Your password needs at least two digit. ";

        return false;
    }

    if ($other < 2) {

        $sessionMessage .= " Your password needs at least two non-alphanumeric characters. ";

        return false;
    }

    if ($other > $max) {

        $sessionMessage .= " The password has too many special characters. ";

        return false;
    }

    /**
     * Remove characters with ASCII value < 32
     */

    $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

    return true;
}