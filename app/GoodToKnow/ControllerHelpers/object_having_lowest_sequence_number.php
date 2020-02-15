<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @return mixed
 */
function object_having_lowest_sequence_number(array &$array_of_objects)
{
    /**
     * It returns the object which has the lowest sequence number and it removes that object from the array.
     */

    if (empty($array_of_objects)) breakout(' Error 07007. ');

    $key_of_lowest = -1;

    $lowest_sequence_number = 40000001;

    foreach ($array_of_objects as $key => $object) {

        if ($object->sequence_number <= $lowest_sequence_number) {

            $key_of_lowest = $key;

            $lowest_sequence_number = $object->sequence_number;

        }
    }

    if ($key_of_lowest === -1) {

        breakout(' Error 124212. ');

    }

    $object_with_lowest_sequence_number = $array_of_objects[$key_of_lowest];

    unset($array_of_objects[$key_of_lowest]);

    return $object_with_lowest_sequence_number;
}