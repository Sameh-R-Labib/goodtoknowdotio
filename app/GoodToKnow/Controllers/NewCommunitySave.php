<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class NewCommunitySave
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description


        kick_out_nonadmins();


        $community_as_array = ['community_name' => $saved_str01, 'community_description' => $saved_str02];


        $community = Community::array_to_object($community_as_array);


        $db = get_db();


        $result = $community->save($db, $sessionMessage);


        if (!$result) {
            breakout(' NewCommunitySave says: Unexpected save was unable to save the new community. ');
        }


        breakout(' The new community has been created  👍🏿. ');
    }
}