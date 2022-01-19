<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $currency
 * @param string $amount
 * @return string
 */
function readable_amount_no_commas(string $currency, string $amount): string
{

    /**
     * This function will format a monetary amount so
     * that (A) the whole part will not have comma separated
     * thousands and (B) it will result in an appropriate
     * quantity of decimal places.
     */

    require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';
    require_once CONTROLLERHELPERS . DIRSEP . 'is_sixteen_decimal_places_currency.php';


    if (!is_crypto($currency)) {

        // It's fiat

        return number_format($amount, 2, '.', '');

    } elseif (is_sixteen_decimal_places_currency($currency)) {

        // It's a sixteen decimal place currency

        // Don't use number_format() because it will alter the value since PHP has limited floating point precision.
        /*return number_format($amount, 16, '.', '');*/

        return $amount;

    } else {

        // It's an eight decimal place currency

        return number_format($amount, 8, '.', '');

    }

}