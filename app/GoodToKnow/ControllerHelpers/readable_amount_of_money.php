<?php


namespace GoodToKnow\ControllerHelpers;


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
    $fiat_currencies = ['💵', '$', 'USD', 'dollar', 'US dollar', 'Dollar', 'US Dollar', 'ARS', 'AUD', 'BSD', 'BBD',
        'BYN', 'BZD', 'BMD', 'BOB', '$b', 'BAM', 'KM', 'BRL', 'R$', 'CAD', 'KYD', 'CLP', 'CNY', '¥', 'COP', 'CRC', '₡',
        'HRK', 'kn', 'CUP', '₱', 'CZK', 'Kč', 'DKK', 'kr', 'DOP', 'RD$', 'EGP', '£', 'EUR', '€', 'HNL', 'L', 'HKD',
        'INR', 'IRR', '﷼', 'ILS', '₪', 'JPY', '¥', 'KPW', '₩', 'KRW', 'MYR', 'RM', 'MXN', 'ANG', 'ƒ', 'NZD', 'NIO',
        'C$', 'NGN', '₦', 'NOK', 'kr', 'PKR', '₨', 'PAB', 'B/.', 'PEN', 'S/.', 'PHP', '₱', 'QAR', 'RUB', '	₽', 'SAR',
        'RSD', 'Дин.', 'SGD', 'ZAR', 'R', 'SEK', 'kr', 'CHF', 'SYP', 'TWD', 'NT$', 'TRY', 'UAH', '₴', 'GBP', 'VEF', 'Bs',
        'VND', '₫', 'YER', 'ZWD', 'Z$', '¢', '₣', '₲', 'ლ', 'лв.', '₺', '₥', '₹', '৳', '₮', 'zł', 'franc'];

    if (in_array($currency, $fiat_currencies)) {
        return number_format($amount, 2);
    }
    return number_format($amount, 8);
}