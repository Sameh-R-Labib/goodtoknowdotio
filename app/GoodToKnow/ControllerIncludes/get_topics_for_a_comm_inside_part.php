<?php

use GoodToKnow\Models\CommunityToTopic;


global $g;


kick_out_loggedoutusers();


/**
 * Refresh special_topic_array
 */

get_db();

$g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);

if ($g->special_topic_array == false) $g->special_topic_array = [];

$_SESSION['special_topic_array'] = $g->special_topic_array;

$_SESSION['last_refresh_topics'] = time();


// Abort if the community doesn't have any topics yet

if (empty($g->special_topic_array)) {

    breakout(' Aborted because this community has no topics. ');

}

$g->html_title = 'Which topic is your post in?';