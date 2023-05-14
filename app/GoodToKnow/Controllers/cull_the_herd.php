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

            breakout(' There are no changed_content objects in the system. ');

        }


        /**
         * Redirect and give a message explaining what was accomplished.
         */

        breakout(" The cull process deleted " . $num_affected_rows . " expired and removed duplicate records. ");
    }
}