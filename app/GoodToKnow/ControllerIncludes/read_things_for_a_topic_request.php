<?php

use GoodToKnow\Models\topic;
use GoodToKnow\Models\topic_to_post;

/**
 * This is to be used in routes:
 * - home
 * - set_home_community_topic_post
 *
 * This is to be used when:
 * - $g->type_of_resource_requested == 'topic';
 *
 * This is to be used for:
 * - Reading the data which is related to a request for a home page which shows a topic.
 * - Making the data available for the home view.
 * - Saving the data in the session file.
 */


global

$g;

// Breakout if the user specified topic id is non-zero and is not in $g->special_topic_array.
if ($g->topic_id != 0 && !array_key_exists($g->topic_id, $_SESSION['special_topic_array'])) {
    breakout(" Your resource request is defective.  (errno 6) ");
}

// Get the topic object.
$topic_object = topic::find_by_id($g->topic_id);

if (!$topic_object) {
    breakout(" I could not get the topic object. ");
}

// Store the topic name and description.
$_SESSION['topic_name'] = $topic_object->topic_name;
$_SESSION['topic_description'] = $topic_object->topic_description;
$g->topic_name = $topic_object->topic_name;
$g->topic_description = $topic_object->topic_description;

// Get a fresh copy of $g->special_post_array.
$g->special_post_array = topic_to_post::special_get_posts_array_for_a_topic($g->topic_id);
if (!$g->special_post_array) $g->special_post_array = [];

// Store the special post array.
$_SESSION['special_post_array'] = $g->special_post_array;
$g->last_refresh_posts = time();
$_SESSION['last_refresh_posts'] = $g->last_refresh_posts;