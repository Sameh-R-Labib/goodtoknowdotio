<?php

use GoodToKnow\Models\CommunityToTopic;

global $sessionMessage;
global $community_id;

/**
 * Refresh special_topic_array
 */

$db = get_db();

$special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

if ($special_topic_array == false) $special_topic_array = [];

$_SESSION['special_topic_array'] = $special_topic_array;

$_SESSION['last_refresh_topics'] = time();


// Abort if the community doesn't have any topics yet

if (empty($special_topic_array)) {
    breakout(' Aborted because this community has no topics. ');
}

$html_title = 'Which topic is your post in?';