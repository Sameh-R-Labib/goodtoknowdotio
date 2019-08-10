<?php


namespace GoodToKnow\ControllerHelpers;


function get_readable_time($created): int
{
    $created = (int)$created;
    $date = date('m/d/Y h:ia ', $created) . "<small>[" . date_default_timezone_get() . "]</small>";
    return $date;
}