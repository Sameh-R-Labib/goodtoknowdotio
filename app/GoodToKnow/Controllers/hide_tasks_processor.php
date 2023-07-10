<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;
use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;

class hide_tasks_processor
{
    function page()
    {
        /**
         * Get the submitted checkboxes. And, use that information to hide
         * their associated task records.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        // This route is similar to the well documented include get_the_submitted_community_ids.php


        require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

        $g->submitted_task_ids = checkbox_section_form_field_prep('choice-');

        if (empty($g->submitted_task_ids)) {

            breakout(' You did not submit any tasks to hide. ');

        }


        foreach ($g->submitted_task_ids as $item) {

            if (!is_numeric($item)) {

                breakout(' Unexpectedly one or more task id values turned out to be non-numeric. ');

            }

        }


        /**
         * Get all the task records which are not hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'show'";

        $g->array_of_objects = task::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any visible tasks. ');

        }


        /**
         * Set to 'hide' the tasks which are in $g->submitted_task_ids
         */

        $count = 0;

        foreach ($g->array_of_objects as $object) {

            // if $object->id is one of the values in $g->submitted_task_ids
            // then make $object->visibility equal to 'hide'.
            if (in_array($object->id, $g->submitted_task_ids)) {

                $object->visibility = 'hide';

                $result = $object->save();

                if ($result === false) {

                    breakout(' Error 04497: I failed at saving a task object. ');

                }

                $count++;
            }
        }


        /**
         * Declare success.
         */

        breakout(" $count to-be hidden tasks became hidden. ");

    }
}