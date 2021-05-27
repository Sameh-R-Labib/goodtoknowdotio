<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;

class CreateNewPostSave
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $html_title;
        global $type_of_resource_requested;
        global $user_id;
        global $topic_id;
        global $saved_str01;                // The main title
        global $saved_str02;                // The title extension
        global $saved_int01;                // The topic id
        global $saved_int02;                // The sequence number


        kick_out_loggedoutusers();


        $db = get_db();


        /**
         * Overview
         *   Mainly we are here to store the new Post and its TopicToPost record. Then
         * redirect to a form for content creation.
         *
         * So far we have:
         *   - $user_id     (user_id)
         *   - $saved_str01 (title)
         *   - $saved_str02 (extesionfortitle)
         *   - $saved_int01 (topic id)
         *   - $saved_int02 (sequence_number)
         *
         * Attributes we need to find values for:
         *   o $created
         *   o $markdown_file (just the file name)
         *   o $html_file (just the file name)
         *
         * Note: Before we save we will (again) verify that nobody has inserted a post in
         * our topic which has the sequence number.
         */


        /**
         * Verify that our sequence number hasn't been taken.
         */

        $result = TopicToPost::get_posts_array_for_a_topic($db, $saved_int01);

        $sequence_number_already_exists_in_db = false;

        if ($result != false) {

            foreach ($result as $object) {

                $a = (int)$object->sequence_number;

                if ($a == (int)$saved_int02) {

                    $sequence_number_already_exists_in_db = true;
                    break;

                }
            }
        }

        if ($sequence_number_already_exists_in_db) {

            breakout(' Unfortunately someone was putting a post in the same spot while you were
            trying to do the same and they beat you to the punch. Please start over. ');

        }


        /**
         * Initialize some variables.
         */

        $created = time();

        $filenamestub = '';


        /**
         * I need to generate the random part of the file name.
         * I need to make sure the generated filename doesn't already exist.
         */

        try {

            $filenamestub = random_bytes(5);

        } catch (\Exception $e) {

            $sessionMessage .= ' CreateNewPostSave page() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

        }

        if (!empty($sessionMessage)) {

            breakout('');

        }

        $filenamestub = bin2hex($filenamestub);

        $markdown_file = tempnam(MARKDOWN, $filenamestub);

        $html_file = tempnam(STATICHTML, $filenamestub);

        if (!$markdown_file || !$html_file) {

            breakout(' Failed to create files. ');

        }

        // Assemble the Post object

        $post_as_array = ['sequence_number' => $saved_int02, 'title' => $saved_str01, 'extensionfortitle' => $saved_str02,
            'user_id' => $user_id, 'created' => $created, 'markdown_file' => $markdown_file, 'html_file' => $html_file];

        $post = Post::array_to_object($post_as_array);


        // Save the new Post

        $result = $post->save($db, $sessionMessage);

        if (!$result) {

            breakout(' CreateNewPostSave: Unexpected save was unable to save the new post. ');

        }


        // Assemble the TopicToPost object

        $topictopost_as_array = ['topic_id' => $saved_int01, 'post_id' => $post->id];

        $topictopost = TopicToPost::array_to_object($topictopost_as_array);

        // Save the new TopicToPost

        $result = $topictopost->save($db, $sessionMessage);

        if (!$result) {

            breakout(' CreateNewPostSave: Unexpected save was unable to save the TopicToPost. ');

        }


        /**
         * Refresh special_post_array if ($type_of_resource_requested === 'topic')
         */

        if ($type_of_resource_requested === 'topic' || $type_of_resource_requested === 'post') {

            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $topic_id);

            if ($special_post_array === false) {

                breakout(' CreateNewPostSave says: Unexpected unable to get special post array. ');

            }

            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();

        }


        /**
         * No we are not going to break out here.
         *
         * We are going to store the id of the newly created post and present an editor form
         * so the user can add content to the post.
         */

        $_SESSION['saved_int02'] = $post->id;

        $html_title = 'Editor';

        require VIEWS . DIRSEP . 'createnewposteditor.php';
    }
}