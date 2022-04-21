<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @param int $point_of_reference_sequence_number
 * @return int
 */
function get_sequence_number_in_case_after(array $array_of_objects, int $point_of_reference_sequence_number): int
{
    /**
     * The goal is to return the sequence number for placement of the next object after a specified point of reference
     * object's sequence number.
     */

    $sequence_number_of_currently_following_object = 0;


    /**
     * Obviously, there can't be a sequence number to be gotten in the case where our point of reference
     * object is the last object (since here we are looking to place the new object AFTER the point of reference object.)
     */

    if ($point_of_reference_sequence_number === UPPERLIMITSEQNUM) breakout(' Please choose another place to put the new object. ');


    /**
     * If there are no objects after the point of reference object then we will assume a value of UPPERLIMITSEQNUM
     * for the currently next object.
     */

    $there_is_an_object_after_the_por_object = false;

    foreach ($array_of_objects as $object) {

        if ($object->sequence_number > $point_of_reference_sequence_number) {

            $there_is_an_object_after_the_por_object = true;

            break;

        }
    }

    if (!$there_is_an_object_after_the_por_object) {

        $sequence_number_of_currently_following_object = UPPERLIMITSEQNUM;

    } else {

        foreach ($array_of_objects as $object) {

            if ($object->sequence_number > $point_of_reference_sequence_number) {

                $sequence_number_of_currently_following_object = $object->sequence_number;

                break;

            }

        }

    }

    $difference = $sequence_number_of_currently_following_object - $point_of_reference_sequence_number;

    $increase = intdiv($difference, 16);

    if ($increase < 1) {

        breakout(' Please choose another place to put the object. ');

    }

    return $point_of_reference_sequence_number + $increase;
}