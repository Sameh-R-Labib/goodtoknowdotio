<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $timestamp
 * @return array
 */
function get_date_h_m_s_from_a_timestamp(string $timestamp): array
{
    /**
     * Returned values depend on the default timezone for the script.
     *
     * Returns an array having elements as follows:
     * - ['date'] : (string) a date in the form mm/dd/YYYY.
     * - ['hour'] : (string) 0-23 military hour.
     * - ['minute'] : (string) 0-59 minutes.
     * - ['second'] : (string) 0-59 seconds.
     *
     * No leading zeroes for hour, minute and second.
     *
     * This array will be used to pre-populate form fields for the specified timestamp.
     *
     * It is assumed that the timestamp is valid.
     */

    $timestamp = (int)$timestamp;

    $array = [];

    $array['date'] = date('m/d/Y', $timestamp);

    $array['hour'] = date('G', $timestamp);

    $array['minute'] = date('i', $timestamp);

    // Remove leading zeros from the minutes.
    // Side note: In PHP '00' == '0'
    if ($array['minute'] != '0') {

        $array['minute'] = ltrim($array['minute'], '0');

    }

    if ($array['minute'] === '00') {

        $array['minute'] = '0';

    }

    $array['second'] = date('s', $timestamp);

    // Remove leading zeros from the seconds.
    // Side note: In PHP '00' == '0'
    if ($array['second'] != '0') {

        $array['second'] = ltrim($array['second'], '0');

    }

    if ($array['second'] === '00') {

        $array['second'] = '0';

    }

    return $array;
}