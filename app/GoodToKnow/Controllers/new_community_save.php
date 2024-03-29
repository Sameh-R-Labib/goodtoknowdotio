<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;

class new_community_save
{
    function page()
    {
        global $g;
        // $g->saved_str01 the topic name
        // $g->saved_str02 the topic description


        kick_out_nonadmins();


        $community_as_array = ['community_name' => $g->saved_str01, 'community_description' => $g->saved_str02];


        $community = community::array_to_object($community_as_array);


        get_db();


        $result = $community->save();


        if (!$result) {

            breakout(' new_community_save says: Unexpected save was unable to save the new community. ');

        }


        breakout(' The new community has been created  👍🏿. ');
    }
}