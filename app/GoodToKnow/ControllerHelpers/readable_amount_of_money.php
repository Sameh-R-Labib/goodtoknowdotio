<?php


namespace GoodToKnow\ControllerHelpers;


/**
 * @param string $currency
 * @param string $amount
 * @return string
 */
function readable_amount_of_money(string $currency, string $amount): string
{
    /**
     * This function will format a monetary amount so
     * that (A) the whole part will have comma separated
     * thousands and (B) it will result in decimal places
     * according to the following rules:
     * 1) If the currency is a government fiat currency then only 2 decimal places will be in the result.
     * 2) If not then (assumed to be a crypto-currency) 8 decimal places will be in the result.
     *
     * It is assumed that the parameter $amount is a string version of a 16 digit floating number having 8 decimal places.
     */

    require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';

    if (!is_crypto($currency)) {

        return number_format($amount, 2);

    }
    return number_format($amount, 8);
}