<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\Task;


class FeatureATaskEdit
{
    function page()
    {
        /**
         * 1) Store the submitted task id in the session.
         * 2) Retrieve the task object with that id from the database.
         * 3) Present a form which is populated with data from the task object.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted task id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $id;

        /**
         * 2) Retrieve the task object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $object = Task::find_by_id($db, $sessionMessage, $id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly, I could not find that task record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the task object.
         */
        $html_title = 'Edit the task record';

        require VIEWS . DIRSEP . 'featureataskedit.php';
    }
}