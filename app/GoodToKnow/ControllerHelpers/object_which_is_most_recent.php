<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @param $time_field_name
 * @return object
 */
function object_which_is_most_recent(array &$array_of_objects, $time_field_name): object
{
    /**
     * It returns the object which has the highest time value and it removes that object from the array.
     */

    if (empty($array_of_objects)) {

        breakout(' The function failed because it received an empty array. ');

    }

    $key_of_most_recent = -1;

    $time_of_most_recent = 0;

    foreach ($array_of_objects as $key => $object) {

        if ($object->$time_field_name > $time_of_most_recent) {

            $key_of_most_recent = $key;
            $time_of_most_recent = $object->$time_field_name;

        }
    }

    if ($key_of_most_recent == -1) {

        breakout(' Error 524210. ');

    }

    $object_which_is_most_recent = $array_of_objects[$key_of_most_recent];

    unset($array_of_objects[$key_of_most_recent]);

    return $object_which_is_most_recent;
}