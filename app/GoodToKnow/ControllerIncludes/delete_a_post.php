<?php

use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;


global $app_state;
global $db;
global $saved_int01;
global $saved_int02;


$db = get_db();

$post = Post::find_by_id($saved_int02);

if (!$post) {

    breakout(' Could not find post by id. ');

}

$result = $post->delete();

if (!$result) {

    breakout(' Unexpectedly could not delete post. ');

}


// Delete the TopicToPost record

$sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $db->real_escape_string($saved_int01) . '" AND `post_id` = "' .
    $db->real_escape_string($saved_int02) . '" LIMIT 1';

$array_of_objects = TopicToPost::find_by_sql($sql);

if (!$array_of_objects || !empty($app_state->message)) {

    breakout(' Unexpectedly failed to get a TopicToPost object to delete. ');

}

$topictopost_object = array_shift($array_of_objects);

if (!is_object($topictopost_object)) {

    breakout(' Unexpectedly return value is not an object. ');

}

$result = $topictopost_object->delete();

if (!$result) {

    breakout(' Unexpectedly could not delete the TopicToPost object. ');

}


// Delete both its files.

$result = unlink($app_state->saved_str01);

if (!$result) {

    breakout(' Unexpectedly failed to delete markdown file for the post. ');

}

$result = unlink($app_state->saved_str02);

if (!$result) {

    breakout(' Unexpectedly failed to delete html file for the post. ');

}


// Report successful deletion of post.

breakout(' I just deleted your post. ');