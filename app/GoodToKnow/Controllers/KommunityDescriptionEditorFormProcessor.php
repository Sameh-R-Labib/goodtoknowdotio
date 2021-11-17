<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class KommunityDescriptionEditorFormProcessor
{
    function page()
    {
        /**
         * The purpose is to:
         *  1) Read the edited community's description.
         *  2 & 3) Removed source code.
         *  4) Get a copy of the Community object.
         *  5) Makes sure the description is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *  6) Replace the Community's current description with the new one.
         *  7) Update the database with this Community object.
         */

        global $g;
        // $g->saved_str01 the community's name
        // $g->saved_int01 the community's id

        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         *  1) Read the edited community's description.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_description = standard_form_field_prep('text', 0, 800);


        /**
         *  4) Get a copy of the Community object.
         */

        get_db();

        $community_object = Community::find_by_id($g->saved_int01);

        if (!$community_object) {

            breakout(' Unexpected failed to retrieve the community object. ');

        }


        /**
         *  5) Makes sure the description is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *
         *  Yes this is t.c.o. automatically. So, don't worry about it!
         */


        /**
         *  6) Replace the Community's current description with the new one.
         */

        $community_object->community_description = $edited_description;


        /**
         *  7) Update the database with this Community object.
         */

        $result = $community_object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated community object. ');

        }


        /**
         * Report success.
         */

        breakout(" I have updated $g->saved_str01's record. ");
    }
}