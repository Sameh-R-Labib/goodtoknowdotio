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

    global $app_state;

    $race = trim($race);
    if (empty($race)) {
        $app_state->message .= " The value for race is missing. ";
        return false;
    }

    $races = ['caucasian-american', 'caucasian-european', 'caucasian-african', 'black-european', 'black-american',
        'black-african', 'asian', 'south-american', 'greek', 'middle-eastern-christian', 'middle-eastern-moslem',
        'native-american'];

    if (!in_array($race, $races)) {
        $app_state->message .= " Your race field does not contain a valid value. ";
        return false;
    }

    return true;
}