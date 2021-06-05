<?php

use GoodToKnow\Models\CommunityToTopic;


global $app_state;
global $db;


kick_out_loggedoutusers();


/**
 * Refresh special_topic_array
 */

$db = get_db();

$app_state->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($app_state->community_id);

if ($app_state->special_topic_array == false) $app_state->special_topic_array = [];

$_SESSION['special_topic_array'] = $app_state->special_topic_array;

$_SESSION['last_refresh_topics'] = time();


// Abort if the community doesn't have any topics yet

if (empty($app_state->special_topic_array)) {

    breakout(' Aborted because this community has no topics. ');

}

$app_state->html_title = 'Which topic is your post in?';