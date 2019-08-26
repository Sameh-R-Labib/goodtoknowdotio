<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class NewCommunitySave
{
    function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        $db = get_db();

        $community_as_array = ['community_name' => $saved_str01, 'community_description' => $saved_str02];

        $community = Community::array_to_object($community_as_array);

        $result = $community->save($db, $sessionMessage);

        if (!$result) {
            breakout(' NewCommunitySave says: Unexpected save was unable to save the new community. ');
        }


        // Redirect

        breakout(' The new community has been created  👍🏿. ');
    }
}