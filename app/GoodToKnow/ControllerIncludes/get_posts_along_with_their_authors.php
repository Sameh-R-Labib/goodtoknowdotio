<?php

use GoodToKnow\Models\topic_to_post;


global $g;
// $g->saved_int01 id of topic


$g->array_of_post_objects = topic_to_post::get_posts_array_for_a_topic($g->saved_int01);

if (!$g->array_of_post_objects) {

    breakout(' This topic does not contain any posts. ');

}


/**
 * Generate an array of author usernames. Each array element's value is a username which
 * is the username corresponding to the user_id of the corresponding element in the $g->array_of_post_objects.
 */

$g->array_of_author_usernames = topic_to_post::get_author_usernames($g->array_of_post_objects);


if (!$g->array_of_author_usernames) {

    breakout(' Anomalous condition: Supposedly we have posts but do not have any authors. ');

}
