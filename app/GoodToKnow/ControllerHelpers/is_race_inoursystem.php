<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $race
 * @return bool
 */
function is_race_inoursystem(string &$race): bool
{
    /**
     * Trim it.
     * Can't be empty.
     * Must be one of the ones I have in the form.
     */

    global $gtk;

    $race = trim($race);
    if (empty($race)) {
        $gtk->message .= " The value for race is missing. ";
        return false;
    }

    $races = ['caucasian-american', 'caucasian-european', 'caucasian-african', 'black-european', 'black-american',
        'black-african', 'asian', 'south-american', 'greek', 'middle-eastern-christian', 'middle-eastern-moslem',
        'native-american'];

    if (!in_array($race, $races)) {
        $gtk->message .= " Your race field does not contain a valid value. ";
        return false;
    }

    return true;
}