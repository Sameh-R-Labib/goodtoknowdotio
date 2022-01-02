<?php

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

global $g;

$g->commodity_object->time = get_readable_time($g->commodity_object->time);
$g->commodity_object->comment = nl2br($g->commodity_object->comment, false);
$g->commodity_object->price_point = readable_amount_of_money($g->commodity_object->currency, $g->commodity_object->price_point);
$g->commodity_object->initial_balance = readable_amount_of_money($g->commodity_object->commodity, $g->commodity_object->initial_balance);
$g->commodity_object->current_balance = readable_amount_of_money($g->commodity_object->commodity, $g->commodity_object->current_balance);