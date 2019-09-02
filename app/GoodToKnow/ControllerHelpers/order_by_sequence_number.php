<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 */
function order_by_sequence_number(array &$array_of_objects)
{
    /**
     * It rearranges the objects to be in increasing sequence number as you traverse the array.
     */

    if (empty($array_of_objects)) breakout(' I can not rearrange an empty array. ');

    $array_of_rearranged_objects = [];

    $count = count($array_of_objects);

    $temp_array = $array_of_objects;

    while ($count > 0) {

        $array_of_rearranged_objects[] = object_having_lowest_sequence_number($temp_array);

        $count -= 1;

    }

    $array_of_objects = $array_of_rearranged_objects;
}