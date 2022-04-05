<?php

use GoodToKnow\Models\post;
use GoodToKnow\Models\topic_to_post;


global $g;


$post = post::find_by_id($g->saved_int02);

if (!$post) {

    breakout(' Could not find post by id. ');

}

$result = $post->delete();

if (!$result) {

    breakout(' Unexpectedly could not delete post. ');

}


// Delete the topic_to_post record

$sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $g->db->real_escape_string((string)$g->saved_int01) . '" AND `post_id` = "' .
    $g->db->real_escape_string((string)$g->saved_int02) . '" LIMIT 1';

$array_of_objects = topic_to_post::find_by_sql($sql);

if (!$array_of_objects) {

    breakout(' Unexpectedly failed to get a topic_to_post object to delete. ');

}

$topictopost_object = array_shift($array_of_objects);

if (!is_object($topictopost_object)) {

    breakout(' Unexpectedly return value is not an object. ');

}

$result = $topictopost_object->delete();

if (!$result) {

    breakout(' Unexpectedly could not delete the topic_to_post object. ');

}


// Delete both its files.

$result = unlink($g->saved_str01);

if (!$result) {

    breakout(' Unexpectedly failed to delete markdown file for the post. ');

}

$result = unlink($g->saved_str02);

if (!$result) {

    breakout(' Unexpectedly failed to delete html file for the post. ');

}


// Report successful deletion of post.

breakout(' I just deleted your post. ');