<?php

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;


global $g;


/**
 * Loop through the array and replace attributes with more readable ones.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


foreach ($g->array as $item) {

    $item->purchase = (float)$item->price_bought * (float)$item->commodity_amount;
    $item->sale = (float)$item->price_sold * (float)$item->commodity_amount;
    $item->purchase = readable_amount_of_money($item->currency_transacted, $item->purchase);
    $item->sale = readable_amount_of_money($item->currency_transacted, $item->sale);
    $item->time_bought = get_readable_time($item->time_bought);
    $item->time_sold = get_readable_time($item->time_sold);
    $item->price_bought = readable_amount_of_money($item->currency_transacted, $item->price_bought);
    $item->price_sold = readable_amount_of_money($item->currency_transacted, $item->price_sold);
    $item->profit = readable_amount_of_money($item->currency_transacted, $item->profit);
    $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

}

