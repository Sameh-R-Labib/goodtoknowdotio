<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $currency
 * @return bool
 */
function is_crypto(string $currency): bool
{
    /**
     * assumption:
     *  - "is_crypto" means "is not fiat"
     *  - "is not crypto" means "is fiat"
     *  - it has to be one or the other (but never can be both.)
     */

    // List of all known fiat currencies

    $fiat_currencies = ['💵', '$', 'USD', 'usd', 'dollar', 'US dollar', 'Dollar', 'US Dollar', 'ARS', 'AUD', 'BSD', 'BBD',
        'BYN', 'BZD', 'BMD', 'BOB', '$b', 'BAM', 'KM', 'BRL', 'R$', 'CAD', 'KYD', 'CLP', 'CNY', '¥', 'COP', 'CRC', '₡',
        'HRK', 'kn', 'CUP', '₱', 'CZK', 'Kč', 'DKK', 'kr', 'DOP', 'RD$', 'EGP', '£', 'EUR', '€', 'HNL', 'L', 'HKD',
        'INR', 'IRR', '﷼', 'ILS', '₪', 'JPY', '¥', 'KPW', '₩', 'KRW', 'MYR', 'RM', 'MXN', 'ANG', 'ƒ', 'NZD', 'NIO',
        'C$', 'NGN', '₦', 'NOK', 'kr', 'PKR', '₨', 'PAB', 'B/.', 'PEN', 'S/.', 'PHP', '₱', 'QAR', 'RUB', '	₽', 'SAR',
        'RSD', 'Дин.', 'SGD', 'ZAR', 'R', 'SEK', 'kr', 'CHF', 'SYP', 'TWD', 'NT$', 'TRY', 'UAH', '₴', 'GBP', 'VEF', 'Bs',
        'VND', '₫', 'YER', 'ZWD', 'Z$', '¢', '₣', '₲', 'ლ', 'лв.', '₺', '₥', '₹', '৳', '₮', 'zł', 'franc'];


    if (in_array($currency, $fiat_currencies)) {

        // $currency is fiat
        // thus $currency is not crypto.
        // Therefore, return false.

        return false;

    }


    return true;
}