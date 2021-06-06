<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;

class FeatureATaskEdit
{
    function page()
    {
        /**
         * 1) Store the submitted task id in the session.
         * 2) Retrieve the task object with that id from the database.
         * 3) Make sure that object belongs to this user.
         * 4) Present a form which is populated with data from the task object.
         */


        global $gtk;
        global $object;
        global $next;


        require CONTROLLERINCLUDES . DIRSEP . 'get_task.php';


        /**
         * 4) Present a form which is populated with data from the task object.
         */

        /**
         * This type of record has a field called `last` and a field called `next`. We are Not going to pre-populate
         * form fields with them. Instead we derive the arrays called $gtk->last and $next from them and use
         * the derived arrays to pre-populate the corresponding fields in the form which we present below.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $gtk->last = get_date_h_m_s_from_a_timestamp($object->last);

        $next = get_date_h_m_s_from_a_timestamp($object->next);


        $gtk->html_title = 'Edit the task record';


        require VIEWS . DIRSEP . 'featureataskedit.php';
    }
}