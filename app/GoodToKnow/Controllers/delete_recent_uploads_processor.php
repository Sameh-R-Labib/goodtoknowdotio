<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;

class delete_recent_uploads_processor
{
    function page()
    {
        kick_out_nonadmins();


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
         * Loop through $submitted_ids_array and delete the files associated with the
         * changed_content database table rows specified by $submitted_ids_array.
         *
         * The term id in $submitted_ids_array refers to a changed_content id.
         */

        get_db();

        $count = 0;

        foreach ($submitted_ids_array as $id_of_a_changed_content) {

            $changed_content_object = changed_content::find_by_id($id_of_a_changed_content);

            if (!$changed_content_object) {
                breakout(' Error 91493908. ');
            }

            // Delete the upload file.
            $did_delete_upload = unlink(IMAGE . DIRSEP . $changed_content_object->name);
            if (!$did_delete_upload) breakout(' There was a problem with deleting the file. ');

            $result = $changed_content_object->delete();

            if (!$result) {
                breakout(' Unexpectedly could not delete a changed_content row. ');
            }

            $count++;

        }


        /**
         * Redirect and give a message explaining what was accomplished.
         */

        breakout(" I deleted $count DANGEROUS uploads. ");
    }
}