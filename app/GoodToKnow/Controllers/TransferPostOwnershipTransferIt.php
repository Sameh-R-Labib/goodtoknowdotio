<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class TransferPostOwnershipTransferIt
{
    function page()
    {
        /**
         * Last function for TransferPostOwnershipTransferIt.
         *
         * Here we take the username submitted and use it to make its id part of the record for for the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $saved_int02;  // Post id

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $username = standard_form_field_prep('username', 7, 12);


        // Get the user id which corresponds with the username.

        $user_object = User::find_by_username($db, $sessionMessage, $username);

        if (!$user_object) {

            breakout(' Unexpectedly unable to retrieve target user\'s object. ');

        }

        $user_id = (int)$user_object->id;


        // Get the Post object.

        $post_object = Post::find_by_id($db, $sessionMessage, $saved_int02);

        if (!$post_object) {

            breakout(' TransferPostOwnershipTransferIt says: Unexpected could not get a post object. ');

        }


        // Change the user_id to that of the new person.

        $post_object->user_id = $user_id;


        // Save the Post to the database.

        $result = $post_object->save($db, $sessionMessage);

        if ($result === false) {

            breakout(' I was unable to save the updated post. ');

        }


        // Report success.

        breakout(" I've updated \"{$post_object->title}\" post's record to belong to <b>{$username}</b>. ");
    }
}