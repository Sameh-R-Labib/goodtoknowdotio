<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;

class un_tasks_processor
{
    function page()
    {
        /**
         * Get the submitted checkboxes. And, use that information to un-hide
         * their associated task records.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        // This route is similar to the well documented include get_the_submitted_community_ids.php


        require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

        $g->submitted_task_ids = checkbox_section_form_field_prep('choice-');

        if (empty($g->submitted_task_ids)) {

            breakout(' You did not submit any tasks to un-hide. ');

        }

    }
}