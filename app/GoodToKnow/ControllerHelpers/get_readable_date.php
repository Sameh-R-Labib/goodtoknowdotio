<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param $created
 * @return string
 */
function get_readable_date($created): string
{
    $created = (int)$created;

    $date = date('m/d/Y T ', $created);

    return $date;
}