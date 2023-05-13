<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;

class cull_the_herd
{
    function page()
    {
        /**
         * This route will delete expired and  older duplicates changed_content objects from the changed_content
         * database table.
         */


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


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
    }
}