<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class kommunity_description_editor_form_processor
{
    function page()
    {
        global $g;
        // $g->saved_str01 the community's name
        // $g->saved_int01 the community's id

        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         *  1) Read the data.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $community_name = standard_form_field_prep('community_name', 1, 200);

        $community_description = standard_form_field_prep('community_description', 1, 230);


        /**
         *  4) Get a copy of the community object.
         */

        get_db();

        $community_object = community::find_by_id($g->saved_int01);

        if (!$community_object) {

            breakout(' Unexpected failed to retrieve the community object. ');

        }


        /**
         *  6) Replace the community's current name and description with the new one.
         */

        $community_object->community_name = $community_name;

        $community_object->community_description = $community_description;


        /**
         *  7) Update the database with this community object.
         */

        $result = $community_object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated community object (most likely because you didn\'t make any changes to it.) ');

        }


        /**
         * Report success.
         */

        breakout(" I updated <b>$g->saved_str01</b>'s record. ");
    }
}