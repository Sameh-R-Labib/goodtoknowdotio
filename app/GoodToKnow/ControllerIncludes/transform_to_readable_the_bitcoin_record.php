<?php

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

global $g;

$g->bitcoin_object->time = get_readable_time($g->bitcoin_object->time);
$g->bitcoin_object->comment = nl2br($g->bitcoin_object->comment, false);
$g->bitcoin_object->price_point = readable_amount_of_money($g->bitcoin_object->currency, $g->bitcoin_object->price_point);


// Since we know these two are crypto we don't need to use readable_amount_of_money()

$g->bitcoin_object->initial_balance = number_format($g->bitcoin_object->initial_balance, 8);
$g->bitcoin_object->current_balance = number_format($g->bitcoin_object->current_balance, 8);