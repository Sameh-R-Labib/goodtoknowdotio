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
            breakout(' The developer decided the script should terminate here when there is already a message. ');
        }


        /**
         * Get all the changed_content objects from the database table named changed_content.
         * Breakout if none are found or if there was a problem trying to get them.
         */

        $array_of_objects = changed_content::find_all();

        if ($array_of_objects === false) {

            // Either there aren't any or there was an error.
            breakout(' Unable to retrieve any changed_content. ');

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
         *
         * Note Regarding PHP
         * ==================
         *     break will stop the current loop (or pass an integer to tell it how
         *     many loops to break from). continue will stop the current iteration
         *     and start the next one.
         */

        $count_of_duplicates = 0;

        // Determine $key_of_last.
        $key_of_last = count($array_of_objects) - 1;

        foreach ($array_of_objects as $key => $the_current_object) {

            // We don't eliminate duplicates when the type is image_upload.
            if ($the_current_object->type == 'image_upload') continue;

            if ($key != $key_of_last) {

                // Go through the rest of the objects looking for a duplicate which is newer.
                $i = $key + 1;
                do {
                    // We've already eliminated the possibility the $the_current_object is an image_upload.
                    if ($the_current_object->post_id == $array_of_objects[$i]->post_id) {
                        // Ask yourself: Should the database table record corresponding to $the_current_object be deleted?
                        // If yes then delete it and do a continue job on the foreach loop.
                        // Otherwise, just do a continue job on the do while loop.

                        // The database table record corresponding to $the_current_object should be deleted
                        // if $array_of_objects[$i]->time > $the_current_object->time
                        if ((int)$array_of_objects[$i]->time > (int)$the_current_object->time) {
                            $the_current_object->delete();
                            $count_of_duplicates++;
                            break;
                        }
                    }

                    // Increment $i.
                    $i++;
                } while ($i <= $key_of_last);

            }

        }


        /**
         * Redirect and give a message explaining what was accomplished.
         */

        breakout(" The cull process deleted $num_affected_rows expired records and $count_of_duplicates duplicates. ");
    }
}