<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use function GoodToKnow\ControllerHelpers\get_readable_date;

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


        kick_out_nonadmins();


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
         * Make the time field of the changed_content objects human-readable.
         */

        // Loop through the array and replace some attributes with more readable versions of themselves.
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_date.php';

        foreach ($g->array_of_objects as $cc_object) {

            $cc_object->time = get_readable_date($cc_object->time);

            if ($cc_object->type == 'image_upload') {
                $a_link_href_content = SERVER_URL . '/image/' . $cc_object->name;
                $a_link_href_content = htmlspecialchars($a_link_href_content, ENT_NOQUOTES | ENT_HTML5);
                $a_link_display_text = SERVER_URL . '/image/' . rawurlencode($cc_object->name);
                $a_link_display_text = htmlspecialchars($a_link_display_text, ENT_NOQUOTES | ENT_HTML5);
                $cc_object->name = '<a href="' . $a_link_href_content . '" target="_blank">' . $a_link_display_text . '</a>';
            }

        }

        // Reverse the order so they show that way.
        $g->array_of_objects = array_reverse($g->array_of_objects);


        /**
         * Present the changed_content objects as check boxes
         */

        $g->html_title = 'Delete changed_content Objects';

        require VIEWS . DIRSEP . 'pickoffsome.php';
    }
}