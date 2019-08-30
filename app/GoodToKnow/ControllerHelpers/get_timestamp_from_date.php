<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $submitted_date
 * @return int
 */
function get_timestamp_from_date(string $submitted_date): int
{
    /**
     * It is assumed that $submitted_date is in the American form of mm/dd/yyyy.
     * For example 01/02/2019
     */

    // Separate the parts of #submitted_date
    $words = explode('/', $submitted_date);
    $day = $words[1];
    $month = $words[0];
    $year = $words[2];

    $timestamp = mktime(0, 0, 0, $month, $day, $year);

    if ($timestamp === false) breakout(' Function mktime bonked 👎🏿. ');

    return $timestamp;
}