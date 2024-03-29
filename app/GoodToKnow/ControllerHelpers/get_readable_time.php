<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param $created
 * @return string
 */
function get_readable_time($created): string
{
    $created = (int)$created;

    return date('m/d/Y h:ia T', $created);
}