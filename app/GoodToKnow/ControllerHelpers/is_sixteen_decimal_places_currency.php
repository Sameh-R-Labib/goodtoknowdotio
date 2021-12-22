<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $currency
 * @return bool
 */
function is_sixteen_decimal_places_currency(string $currency): bool
{

    // List of currencies which get displayed with 16 decimal places

    $sixteen_decimal_places_currencies = ['BAT', 'bat'];


    if (in_array($currency, $sixteen_decimal_places_currencies)) {

        return true;

    }


    return false;

}