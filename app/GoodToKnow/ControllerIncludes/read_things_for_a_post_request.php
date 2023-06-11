<?php

use GoodToKnow\Models\post;
use GoodToKnow\Models\user;

/**
 * This is to be used in routes:
 * - home
 * - set_home_community_topic_post
 *
 * This is to be used when:
 * - $g->type_of_resource_requested == 'post';
 *
 * This is to be used for:
 * - Reading the data which is related to a request for a home page which shows a post.
 * - Making the data available for the home view.
 * - Saving the data in the session file.
 */


global $g;


// Breakout if the post id is not in the special post array.
if (!array_key_exists($g->post_id, $g->special_post_array)) {
    breakout(" Your resource request is defective.  (errno 114) ");
}


// Get the post object and its content.
$post_object = post::find_by_id($g->post_id);

if (!$post_object) {
    breakout(" set_home_community_topic_post says: Error 58498. ");
}

$g->post_content = file_get_contents($post_object->html_file);
if ($g->post_content === false) {
    breakout(" The home page says it's unable to get the current post (but that's okay if you've just deleted it.) ");
}
if (empty(trim($g->post_content))) {
    $g->post_content = '<p><em>[No post content]</em></p>';
}
$g->last_refresh_content = time();

$g->post_name = $post_object->title;

// Generate a publishing date for the post and store the post's full name.
$epoch_time = (int)$post_object->created;
$publish_date = date("m/d/Y", $epoch_time);
$g->post_full_name = $post_object->extensionfortitle . ' <span class="small-time">[' . $publish_date . ']</span>';


// Get and store author information.
$post_author_object = user::find_by_id($post_object->user_id);

if ($post_author_object === false) {
    breakout(" Unable to get the post author object from the database. ");
}

$g->author_username = $post_author_object->username;
$g->author_id = (int)$post_author_object->id;
