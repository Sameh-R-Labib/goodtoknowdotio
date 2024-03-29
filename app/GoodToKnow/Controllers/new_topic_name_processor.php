<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class new_topic_name_processor
{
    function page()
    {
        /**
         * Mission:
         *   - Receive post data for topic_name
         *   - validate
         *   - Replace html tags with html entities
         *   - Add to session
         *   - Redirect to route for saving the new post
         */


        kick_out_nonadmins();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $topic_name = standard_form_field_prep('topic_name', 1, 200);

        $topic_description = standard_form_field_prep('topic_description', 1, 230);


        $_SESSION['saved_str01'] = $topic_name;
        $_SESSION['saved_str02'] = $topic_description;


        redirect_to("/ax1/new_topic_save/page");
    }
}