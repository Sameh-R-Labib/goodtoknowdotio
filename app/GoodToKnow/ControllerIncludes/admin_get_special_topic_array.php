<?php

use GoodToKnow\Models\CommunityToTopic;

global $community_id;

global $sessionMessage;

kick_out_nonadmins();

$db = get_db();

$special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

if ($special_topic_array == false) $special_topic_array = [];

$_SESSION['special_topic_array'] = $special_topic_array;

$_SESSION['last_refresh_topics'] = time();