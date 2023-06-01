<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;

class pick_off_some
{
    function page()
    {
        /**
         * As with "Cull The Herd" feature, the goal is to reduce the amount of
         * changed_content table rows in the database. In the "Pick Off Some" feature
         * we show the administrator some checkboxes next to the names associated with rows
         * of changed_content table. Thus enabling the deletion of one or more rows.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        /**
         * Get all the changed_content objects from the database table named changed_content.
         * Breakout if none are found or if there was a problem trying to get them.
         */

        $g->array_of_objects = changed_content::find_all();

        if ($g->array_of_objects === false) {

            // Either there aren't any or there was an error.
            breakout(' Unable to retrieve any changed_content. ');

        }


        /**
         * Present the changed_content objects as check boxes
         */

        $g->html_title = 'Delete changed_content Objects';

        require VIEWS . DIRSEP . 'pickoffsome.php';
    }
}