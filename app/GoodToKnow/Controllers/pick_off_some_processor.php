<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;

class pick_off_some_processor
{
    function page()
    {
        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Retrieve the ids of the changed_content database table rows
         * which the user has chosen to delete.
         *
         * $submitted_ids_array is an enumerated array of such ids.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

        // The term id refers to the id of a changed_content database table row.
        $submitted_ids_array = checkbox_section_form_field_prep('choice-');

        if (empty($submitted_ids_array)) {
            breakout(' You did not submit any changed_content ids. ');
        }

        foreach ($submitted_ids_array as $item) {
            if (!is_numeric($item)) {
                breakout(' Unexpectedly one or more values turned out to be non-numeric.');
            }
        }


        /**
         * Sample $submitted_ids_array:
         * array(2) {
         *   [0]=>
         *     string(2) "32"
         *   [1]=>
         *     string(2) "20"
         * }
         */


        /**
         * Loop through $submitted_ids_array and delete the changed_content database table rows.
         */

        $count = 0;

        foreach ($submitted_ids_array as $id_of_a_changed_content) {

            $changed_content_object = changed_content::find_by_id($id_of_a_changed_content);

            if (!$changed_content_object) {
                breakout(' Error 91493908. ');
            }

            $result = $changed_content_object->delete();

            if (!$result) {
                breakout(' Unexpectedly could not delete post. ');
            }

            $count++;

        }


        /**
         * Redirect and give a message explaining what was accomplished.
         */

        breakout(" I deleted $count changed_content rows. ");
    }
}