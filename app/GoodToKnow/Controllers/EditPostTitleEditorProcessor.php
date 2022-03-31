<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class EditPostTitleEditorProcessor
{
    function page()
    {
        /**
         * The code here is similar to that which is found in create_new_post_title_processor.
         * However, the mission is slightly different.
         *
         * Mission:
         *   - Run the reception functions for rhe Post's data (main_title and title_extension.)
         *   - Update the Post's database record.
         *
         * Note: the Post id is in $g->saved_int02.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';


        $main_title = standard_form_field_prep('main_title', 1, 200);


        $title_extension = standard_form_field_prep('title_extension', 0, 200);


        get_db();


        $post = Post::find_by_id($g->saved_int02);


        if (!$post) {

            breakout(' Unexpectedly I could not find that Post record. ');

        }


        $post->title = $main_title;
        $post->extensionfortitle = $title_extension;


        $result = $post->save();

        if ($result === false) {

            breakout(' Failed operation to save the Post object. ');

        }


        breakout(" I've updated Post <b>{$post->title}</b>'s record to include changes to its title. ");

    }
}