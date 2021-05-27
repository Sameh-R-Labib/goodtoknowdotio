<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $title
 * @return bool
 */
function is_title_ofaperson(string &$title): bool
{
    /**
     * Trim it.
     * Can't be empty.
     * Mr. and Mrs. are the only valid values for title.
     */

    global $sessionMessage;

    $title = trim($title);

    if (empty($title)) {

        $sessionMessage .= " Your title is missing. ";

        return false;
    }

    $possible = ['Mr.', 'Mrs.'];

    if (!in_array($title, $possible)) {

        $sessionMessage .= " Your title field does not contain a valid value. ";

        return false;
    }

    return true;
}