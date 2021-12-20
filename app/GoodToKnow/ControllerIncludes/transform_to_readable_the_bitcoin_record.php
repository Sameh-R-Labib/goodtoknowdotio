<?php

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

global $g;

$g->bitcoin_object->time = get_readable_time($g->bitcoin_object->time);
$g->bitcoin_object->comment = nl2br($g->bitcoin_object->comment, false);
$g->bitcoin_object->price_point = readable_amount_of_money($g->bitcoin_object->currency, $g->bitcoin_object->price_point);
$g->bitcoin_object->initial_balance = readable_amount_of_money('BTC', $g->bitcoin_object->initial_balance);
$g->bitcoin_object->current_balance = readable_amount_of_money('BTC', $g->bitcoin_object->current_balance);