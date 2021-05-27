<?php

use GoodToKnow\Models\TopicToPost;


global $db;
global $sessionMessage;
global $saved_int01;        // id of topic
global $array_of_author_usernames;
global $array_of_post_objects;


kick_out_nonadmins();


$db = get_db();

$array_of_post_objects = TopicToPost::get_posts_array_for_a_topic($db, $saved_int01);

if (!$array_of_post_objects) {

    breakout(' This topic does not contain any posts. ');

}


/**
 * Generate an array of author usernames. Each array element's value is a username which
 * is the username corresponding to the user_id of the corresponding element in the $array_of_post_objects.
 */

$array_of_author_usernames = TopicToPost::get_author_usernames($db, $array_of_post_objects);

if (!$array_of_author_usernames) {

    breakout(' Anomalous condition: Supposedly we have posts but do not have any authors. ');

}
