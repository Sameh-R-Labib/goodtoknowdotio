<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\post;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class edit_post_title_editor_processor
{
    function page()
    {
        /**
         * The code here is similar to that which is found in create_new_post_title_processor.
         * However, the mission is slightly different.
         *
         * Mission:
         *   - Run the reception functions for rhe post's data (main_title and title_extension.)
         *   - Update the post's database record.
         *
         * Note: the post id is in $g->saved_int02.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';


        $main_title = standard_form_field_prep('main_title', 1, 200);


        $title_extension = standard_form_field_prep('title_extension', 0, 200);


        get_db();


        $post = post::find_by_id($g->saved_int02);


        if (!$post) {

            breakout(' Unexpectedly I could not find that post record. ');

        }


        $post->title = $main_title;
        $post->extensionfortitle = $title_extension;


        $result = $post->save();

        if ($result === false) {

            breakout(' Failed operation to save the post object. ');

        }


        breakout(" I've updated post <b>{$post->title}</b>'s record to include changes to its title. ");

    }
}