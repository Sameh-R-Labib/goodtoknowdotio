<?php

namespace GoodToKnow\Controllers;

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
         * Test
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$submitted_ids_array: </p>\n<pre>";
        var_dump($submitted_ids_array);
        echo "</pre>\n";
        die("<p>End debug</p>\n");


    }
}