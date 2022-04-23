<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param array $array_of_objects
 * @param int $point_of_reference_sequence_number
 * @return int
 */
function get_sequence_number_in_case_before(array $array_of_objects, int $point_of_reference_sequence_number): int
{
    /**
     * The goal is to return the sequence number for placement of the next object BEFORE a specified point of reference
     * object's sequence number.
     */

    $sequence_number_of_currently_trailing_object = UPPERLIMITSEQNUM;


    /**
     * Obviously, there can't be a sequence number to be gotten in the case where our point of reference
     * object is the first object (since here we are looking to place the new object BEFORE the point of reference object.)
     *
     * Anyways, Gtk.io will never be assigning 0 as a sequence number.
     */

    if ($point_of_reference_sequence_number === 0) breakout(' Please choose a different place to put the new object. ');


    /**
     * If there are no objects before the point of reference object then we will assume a value of 0 for the currently
     * previous object.
     */

    $there_is_an_object_before_the_por_object = false;

    foreach ($array_of_objects as $object) {

        if ($object->sequence_number < $point_of_reference_sequence_number) {

            $there_is_an_object_before_the_por_object = true;

            break;

        }
    }

    if (!$there_is_an_object_before_the_por_object) {

        $sequence_number_of_currently_trailing_object = 0;

    } else {

        $reversed = array_reverse($array_of_objects);

        foreach ($reversed as $object) {

            if ($object->sequence_number < $point_of_reference_sequence_number) {

                $sequence_number_of_currently_trailing_object = $object->sequence_number;

                break;

            }

        }

    }

    $difference = $point_of_reference_sequence_number - $sequence_number_of_currently_trailing_object;

    $decrease = intdiv($difference, 16);

    if ($decrease < 1) {

        breakout(' Please choose another place to put the object. ');

    }

    return $point_of_reference_sequence_number - $decrease;

}