<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\post;
use GoodToKnow\Models\user;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class transfer_post_ownership_transfer_it
{
    function page()
    {
        /**
         * Last function for transfer_post_ownership_transfer_it.
         *
         * Here we take the username submitted and use it to make its id part of the record for the post.
         */


        global $g;
        // $g->saved_int02 post id


        kick_out_nonadmins();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $username = standard_form_field_prep('username', 7, 12);


        // Get the user id which corresponds with the username.

        get_db();

        $user_object = user::find_by_username($username);

        if (!$user_object) {

            breakout(' Unexpectedly unable to retrieve target user\'s object. ');

        }

        $user_id = (int)$user_object->id;


        // Get the Blog post object.

        $g->post_object = post::find_by_id($g->saved_int02);

        if (!$g->post_object) {

            breakout(' transfer_post_ownership_transfer_it says: Unexpected could not get a post object. ');

        }


        // Change the user_id to that of the new person.

        $g->post_object->user_id = $user_id;


        // Save the Blog Post to the database.

        $result = $g->post_object->save();

        if ($result === false) {

            breakout(' I was unable to save the updated post. ');

        }


        // Report success.

        breakout(" I've updated <b>\"{$g->post_object->title}\"</b> post's record to belong to <b>{$username}</b>. ");
    }
}