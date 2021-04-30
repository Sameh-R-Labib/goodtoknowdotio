<?php

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

global $bitcoin_object;

$bitcoin_object->time = get_readable_time($bitcoin_object->time);
$bitcoin_object->comment = nl2br($bitcoin_object->comment, false);
$bitcoin_object->price_point = readable_amount_of_money($bitcoin_object->currency, $bitcoin_object->price_point);


// Since we know these two are crypto we don't need to use readable_amount_of_money()

$bitcoin_object->initial_balance = number_format($bitcoin_object->initial_balance, 8);
$bitcoin_object->current_balance = number_format($bitcoin_object->current_balance, 8);