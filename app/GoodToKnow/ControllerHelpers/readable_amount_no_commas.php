<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $currency
 * @param string $amount
 * @return string
 */
function readable_amount_no_commas(string $currency, string $amount): string
{
    require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';

    if (!is_crypto($currency)) {

        return number_format($amount, 2, '.', '');

    }
    return number_format($amount, 8, '.', '');
}