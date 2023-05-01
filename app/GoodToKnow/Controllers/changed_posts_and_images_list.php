<?php

namespace GoodToKnow\Controllers;

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


        $g->page = 'changed_posts_and_images';
    }
}