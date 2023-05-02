<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use function GoodToKnow\ControllerHelpers\get_readable_date;

class changed_posts_and_images_list
{
    function page()
    {
        /**
         * This route is called when the user clicks a link in the view for changed_posts_and_images.
         *
         * This route presents a list of all the changed_content objects stored in the database table.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Generate the data which will be shown to the user.
         */

        // Retrieve all the changed_content objects stored in the database table.
        get_db();

        $g->cc_objects = changed_content::find_all();

        if ($g->cc_objects === false) {
            breakout(' Unable to retrieve changed_content objects. ');
        }

        // Loop through the array and replace some attributes with more readable versions of themselves.
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_date.php';

        foreach ($g->cc_objects as $cc_object) {

            $cc_object->time = get_readable_date($cc_object->time);
            $cc_object->expires = get_readable_date($cc_object->expires);

        }

        // Reverse the order so the show that way.
        $g->cc_objects = array_reverse($g->cc_objects);


        /**
         * Display the output.
         */

        $g->page = 'changed_posts_and_images';

        $g->show_poof = true;

        $g->html_title = 'Changed Posts and Uploaded Images';

        $g->message .= " Here's changed content. Cull it every so often. ";
        // I'm commenting this out since no session feature variables were set for this feature.
        // But, I'm mentioning it here to set a n example showing this is where it would belong.
        /*reset_feature_session_vars();*/
        require VIEWS . DIRSEP . 'changedpostsandimageslist.php';
    }
}