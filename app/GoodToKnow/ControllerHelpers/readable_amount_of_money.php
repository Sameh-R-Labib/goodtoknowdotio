<?php


namespace GoodToKnow\ControllerHelpers;


function readable_amount_of_money(string $amount): string
{
    /**
     * This function will format a monetary amount so
     * that the whole part will have comma separated
     * thousands and it will result in decimal places
     * according to the following rules:
     * 1) If the last 6 digits are all 0 then only 2 decimal places will be in the result.
     * 2) If not then 8 decimal places will be in the result.
     *
     * It is assumed that the parameter $amount is a 16 digit floating number having 8 decimal places.
     */

    $is_standard_currency = false;

    /**
     * If $amount has 6 trailing zeroes then set $is_standard_currency = true.
     */

    // Get the last 6 characters.
    $last_6_characters = substr($amount, -6);

    if ($last_6_characters === "000000") {
        $is_standard_currency = true;
    }

    /**
     * Format the amount according to whether or not it is a standard currency.
     */
    if ($is_standard_currency) {
        return number_format($amount, 2);
    } else {
        return number_format($amount, 8);
    }
}