<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class QuickPostDeleteDelProc
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the post. If yes then
         * delete the post record, delete its TopicToPost record, and delete its html and
         * markdown files. On the other hand if no then reset some session variables and
         * redirect to the home page.
         */

        global $sessionMessage;
        global $saved_int02;
        global $saved_int01;
        global $saved_str01;
        global $saved_str02;

        kick_out_nonadmins();

        kick_out_onabort();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {
            breakout(' Nothing was changed. ');
        }


        /**
         * Delete the record.
         */

        $db = get_db();

        $post = Post::find_by_id($db, $sessionMessage, $saved_int02);

        if (!$post) {

            breakout(' AuthorDeletesOwnPostDelProc says: Could not find post by id. ');

        }

        $result = $post->delete($db, $sessionMessage);

        if (!$result) {

            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly could not delete post. ');

        }


        // Delete the TopicToPost record

        $sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $db->real_escape_string($saved_int01) . '" AND `post_id` = "' .
            $db->real_escape_string($saved_int02) . '" LIMIT 1';

        $array_of_objects = TopicToPost::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly failed to get a TopicToPost object to delete. ');
        }

        $topictopost_object = array_shift($array_of_objects);

        if (!is_object($topictopost_object)) {
            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly return value is not an object. ');
        }

        $result = $topictopost_object->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly could not delete the TopicToPost object. ');
        }


        // Delete both its files.

        $result = unlink($saved_str01);

        if (!$result) {
            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly failed to delete markdown file for the post. ');
        }

        $result = unlink($saved_str02);

        if (!$result) {
            breakout(' AuthorDeletesOwnPostDelProc says: Unexpectedly failed to delete html file for the post. ');
        }


        // Report successful deletion of post.

        breakout(' I have deleted the post. ');
    }
}