<?php

use GoodToKnow\Models\community;
use GoodToKnow\Models\community_to_topic;

/**
 * This is to be used in routes:
 * - home
 * - set_home_community_topic_post
 *
 * This is to be used when:
 * - $g->type_of_resource_requested == 'community';
 *
 * This is to be used for:
 * - Reading the data which is related to a request for a home page which shows a community.
 * - Making the data available for the home view.
 * - Saving the data in the session file.
 */


global $g;


// Breakout if the community does not belong to the user.
if (!array_key_exists($g->community_id, $g->special_community_array)) {
    breakout(" Invalid community_id. ");
}


// Get and store the community community_name and community_description
$community_object = community::find_by_id($g->community_id);

if (!$community_object) {
    breakout(" I could not get the community object. ");
}

$g->community_name = $community_object->community_name;
$g->community_description = $community_object->community_description;


// Get and store the special topic array.
$g->special_topic_array = community_to_topic::get_topics_array_for_a_community($g->community_id);

if (!$g->special_topic_array) $g->special_topic_array = [];
