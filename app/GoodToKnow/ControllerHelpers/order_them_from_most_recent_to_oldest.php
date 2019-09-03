<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @param $time_field_name
 */
function order_them_from_most_recent_to_oldest(array &$array_of_objects, $time_field_name)
{
    /**
     * It takes an array of objects where each object has at least one field that is a unix time stamp.
     * It takes the field name to reorder by.
     * It reorders the array elements in such a way that objects appear from most recent to oldest.
     */

    if (empty($array_of_objects)) breakout(' The function for ordering array elements by time received an empty array. ');

    $sorted = [];

    $count = count($array_of_objects);

    require_once CONTROLLERHELPERS . DIRSEP . 'object_which_is_most_recent.php';

    while ($count > 0) {

        $sorted[] = object_which_is_most_recent($array_of_objects, $time_field_name);

        $count -= 1;

    }

    $array_of_objects = $sorted;
}