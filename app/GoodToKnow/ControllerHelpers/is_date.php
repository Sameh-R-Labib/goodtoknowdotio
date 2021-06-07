<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $date
 * @return bool
 */
function is_date(string &$date): bool
{
    /**
     * Returns true if $date string is formatted as mm/dd/yyyy and is a real calender date.
     * Otherwise, returns false.
     *
     * Side Effects: - $date will be trimmed.
     *               - $message may be modified.
     */

    global $g;

    $date = trim($date);

    if (empty($date)) {

        $g->message .= " The date is missing. ";

        return false;

    }

    $number_of_slashes = substr_count($date, '/');

    if ($number_of_slashes != 2) {

        $g->message .= " You don't have two slashes in date. ";

        return false;
    }


    /**
     * Split date into its parts.
     */

    $words = explode('/', $date);

    $mm = $words[0];

    $dd = $words[1];

    $yyyy = $words[2];

    if (strlen($mm) != 2 || strlen($dd) != 2 || strlen($yyyy) != 4) {

        $g->message .= " You did not use correct mm/dd/yyyy date format. ";

        return false;
    }

    if (!is_numeric($mm) || !is_numeric($dd) || !is_numeric($yyyy)) {

        $g->message .= " The date must consist of numeric digits and 2 forward slashes. And, it does not have
            required numeric digits! ";

        return false;
    }

    if (!checkdate($words[0], $words[1], $words[2])) {

        $g->message .= " That's not a valid date. ";

        return false;
    }

    return true;
}