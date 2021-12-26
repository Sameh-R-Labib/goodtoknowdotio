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
     * thousands and (B) it will result in an appropriate
     * quantity of decimal places.
     */

    require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';
    require_once CONTROLLERHELPERS . DIRSEP . 'is_sixteen_decimal_places_currency.php';


    if (!is_crypto($currency)) {

        // It's fiat

        // Debug code
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$amount: </p>\n<pre>";
        var_dump($amount);
        echo "</pre>\n";

        return number_format($amount, 2);

    } elseif (is_sixteen_decimal_places_currency($currency)) {

        // It's a sixteen decimal place currency

        return number_format($amount, 16);

    } else {

        // It's an eight decimal place currency

        return number_format($amount, 8);

    }

}