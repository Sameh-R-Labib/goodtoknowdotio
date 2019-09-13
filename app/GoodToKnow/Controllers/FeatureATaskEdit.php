<?php

namespace GoodToKnow\Controllers;

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


        require CONTROLLERINCLUDES . DIRSEP . 'get_task.php';


        /**
         * 4) Present a form which is populated with data from the task object.
         */

        $html_title = 'Edit the task record';

        require VIEWS . DIRSEP . 'featureataskedit.php';
    }
}