<?php

use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;

$db = get_db();

global $sessionMessage;

global $saved_int02;

global $saved_int01;

global $saved_str01;

global $saved_str02;

$post = Post::find_by_id($db, $sessionMessage, $saved_int02);

if (!$post) {

    breakout(' Could not find post by id. ');

}

$result = $post->delete($db, $sessionMessage);

if (!$result) {

    breakout(' Unexpectedly could not delete post. ');

}


// Delete the TopicToPost record

$sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $db->real_escape_string($saved_int01) . '" AND `post_id` = "' .
    $db->real_escape_string($saved_int02) . '" LIMIT 1';

$array_of_objects = TopicToPost::find_by_sql($db, $sessionMessage, $sql);

if (!$array_of_objects || !empty($sessionMessage)) {

    breakout(' Unexpectedly failed to get a TopicToPost object to delete. ');

}

$topictopost_object = array_shift($array_of_objects);

if (!is_object($topictopost_object)) {

    breakout(' Unexpectedly return value is not an object. ');

}

$result = $topictopost_object->delete($db, $sessionMessage);

if (!$result) {

    breakout(' Unexpectedly could not delete the TopicToPost object. ');

}


// Delete both its files.

$result = unlink($saved_str01);

if (!$result) {

    breakout(' Unexpectedly failed to delete markdown file for the post. ');

}

$result = unlink($saved_str02);

if (!$result) {

    breakout(' Unexpectedly failed to delete html file for the post. ');

}


// Report successful deletion of post.

breakout(' I just deleted your post. ');