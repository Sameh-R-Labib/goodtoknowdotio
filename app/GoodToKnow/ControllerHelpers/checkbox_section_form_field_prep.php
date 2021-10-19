<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $prepend
 * @return array
 */
function checkbox_section_form_field_prep(string $prepend): array
{
    /**
     * Convention: $prepend must end with a "-" character.
     *
     * Convention: $prepend must be at least 2 characters long.
     *
     *
     * CAUTION: This function simply returns an empty array if the user didn't check any
     * of the checkboxes within specified checkbox section.
     *
     *
     * Description:
     *
     * $prepend is used to define / delineate which submitted field names belong to the
     * checkbox section this function is to care about.
     *
     * You give this function a $prepend string, and it returns an enumerated array
     * containing all the submitted values associated with that prepend.
     *
     * Although this function is intended for reading a submitted section of checkboxes
     * it can read other submitted data which fits the description stated above.
     *
     * For an example of a $_POST[]:
     *
     * array(5) {
     *   ["id"]=> string(1) "9"
     *   ["choice-1"]=> string(1) "3"
     *   ["choice-2"]=> string(1) "8"
     *   ["choice-3"]=> string(2) "12"
     *   ["choice-4"]=> string(2) "15"
     *   ["submit"]=> string(6) "Submit"
     * }
     *
     * where $prepend is 'choice-'
     *
     * we want the return to be:
     *
     * array(4) {
     *   [0]=> string(1) "3"
     *   [1]=> string(1) "8"
     *   [2]=> string(2) "12"
     *   [3]=> string(2) "15"
     */


    /**
     * Make sure that a form was submitted.
     */

    if (empty($_POST) || !is_array($_POST)) {

        breakout(' Unexpected deficiencies in the _POST array. ');

    }

    /**
     * Make sure $prepend is at least two characters long.
     */

    if (strlen($prepend) <= 2) {

        breakout(' The checkbox prepend must be more than 2 characters in length. ');

    }


    /** @var  $array */

    $array = [];


    /**
     * Add to $array each $_POST array element value which has a key that starts with $prepend.
     */

    foreach ($_POST as $key => $value) {

        $substring = substr($key, 0, strlen($prepend));

        // substr() returns the beginning of $key having a maximum length of strlen($prepend).
        // $substring evaluates to false if substr() returns an empty string.
        // $substring should never evaluate to false since $key is at least
        // one character and the length argument to substr() is always greater than 2.

        if ($substring and $substring == $prepend) {

            $array[] = $value;

        }

    }


    return $array;
}