<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;

class cull_the_herd
{
    function page()
    {
        /**
         * This route will delete expired and older duplicate changed_content objects from the changed_content
         * database table.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        /**
         * Delete expired table rows from the changed_content database table.
         */

        $num_affected_rows = 0;

        $sql = 'DELETE FROM `changed_content` WHERE `expires` < ';
        $sql .= $g->db->real_escape_string((string)time());

        try {
            $g->db->query($sql);

            $query_error = $g->db->error;

            if (!empty(trim($query_error))) {
                breakout(' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ');
            }

            $num_affected_rows = $g->db->affected_rows;

        } catch (\Exception $e) {
            $g->message .= ' cull_the_herd delete() exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($g->message)) {
            breakout('');
        }


        /**
         * Get all the changed_content objects from the database table named changed_content.
         */

        $array_of_objects = changed_content::find_all();

        if ($array_of_objects === false) {

            breakout(' Unable to retrieve changed_content. ');

        }

        // Handling the case where NO old messages exist
        if (empty($array_of_objects)) {

            breakout(" The cull process deleted " . $num_affected_rows . " expired records.
            After removal of expired records, there were no changed_content objects to be found. ");

        }


        /**
         * Remove Duplicate Records
         * ========================
         *
         *     The goal here is to delete the database table rows which correspond
         *     to objects within $array_of_objects which are duplicates. We want
         *     the newer database table rows to remain when a duplicate is found.
         *
         * How This Gets Done
         * ==================
         *     Have a foreach loop which traverses $array_of_objects.
         *     In each iteration we compare the current object with the
         *     rest of the objects. As soon as a duplicate is found we
         *     do the proper thing. I will be using a flowchart to determine
         *     what the proper thing should be.
         */

        // Determine $key_of_last.
        $key_of_last = count($array_of_objects) - 1;

        foreach ($array_of_objects as $key => $the_current_object) {

            if ($key != $key_of_last) {

                // Go through the rest of the objects looking for a duplicate which is newer.
                $i = $key + 1;
                do {
                    // Do the comparison.

                    // Increment $i.
                    $i++;
                } while ($i <= $key_of_last);

            }

        }


        /**
         * Redirect and give a message explaining what was accomplished.
         */

        breakout(" The cull process deleted " . $num_affected_rows . " expired records. Additionally, the duplicate
         records have been removed. ");
    }
}