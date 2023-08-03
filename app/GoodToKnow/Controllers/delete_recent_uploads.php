<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use function GoodToKnow\ControllerHelpers\get_readable_date;

class delete_recent_uploads
{
    function page()
    {
        /**
         * This feature presents checkboxes for choosing which image files
         * to delete from the server's file system.
         *
         * The choice is from amongst the uploads listed in the changed_content
         * database table.
         */


        global $g;


        kick_out_nonadmins();


        get_db();


        $sql = 'SELECT * FROM `changed_content` WHERE `type` = "image_upload"';

        $g->array_of_objects = changed_content::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any recently uploaded images ¯\_(ツ)_/¯ ');

        }

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


        $g->html_title = 'Delete DANGEROUS Recent Uploads';

        require VIEWS . DIRSEP . 'deleterecentuploads.php';

    }
}