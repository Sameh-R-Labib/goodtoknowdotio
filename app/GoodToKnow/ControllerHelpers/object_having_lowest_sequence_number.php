<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @return mixed
 */
function object_having_lowest_sequence_number(array &$array_of_objects)
{
    /**
     * It returns the object which has the lowest sequence number, and it removes that object from the array.
     */

    if (empty($array_of_objects)) breakout(' Error 07007. ');

    $key_of_lowest = -1;

    /**
     * In the Gtk.io system no sequence number can be greater
     * than UPPERLIMITSEQNUM (a.k.a. 40,000,000). Since the code below will
     * only work properly when no sequence number is greater than
     * UPPERLIMITSEQNUM, we must make sure that is the case. The code to enforce
     * this is inside the loop below.
     *
     * Gtk.io does not assign a sequence number of UPPERLIMITSEQNUM.
     * However, an anomalous condition may happen. Therefore,
     * we verify we don't have one because we don't want the system to crash.
     */

    // The reason we chose the number UPPERLIMITSEQNUM is that it is the highest "impossible"
    // sequence number. The idea is that we are initializing both
    // $key_of_lowest and $lowest_sequence_number to impossible values
    // and assume their actual values will end up being something else.
    $lowest_sequence_number = UPPERLIMITSEQNUM;

    foreach ($array_of_objects as $key => $object) {

        if ((int)$object->sequence_number >= UPPERLIMITSEQNUM) {

            breakout(' The script has aborted. The reason is that the database has a record which has a sequence number
             that is too high. ');

        }

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