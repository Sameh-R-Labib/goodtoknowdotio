<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Topic;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class TopicDescriptionEditorFormProcessor
{
    function page()
    {
        /**
         * The purpose is to:
         *  1) Read $_POST['text']
         *     (which is the edited community's description.)
         *  2 & 3) Removed source code.
         *  4) Get a copy of the Topic object.
         *  5) Makes sure the description is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *  6) Replace the Topic's current description with the new one.
         *  7) Update the database with this Topic object.
         */

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01;                // The topic's name
        global $saved_int01;                // The topic's id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         *  1) Read $_POST['text']
         *     (which is the edited topic's description.)
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_description = standard_form_field_prep('text', 0, 800);

        if (is_null($edited_description)) {
            $sessionMessage .= " The edited description did NOT pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         *  4) Get a copy of the Topic object.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }
        $topic_object = Topic::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$topic_object) {
            $sessionMessage .= " Unexpected failed to retrieve the topic object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
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
         *  6) Replace the Topic's current description with the new one.
         */
        $topic_object->topic_description = $edited_description;

        /**
         *  7) Update the database with this Topic object.
         */
        $result = $topic_object->save($db, $sessionMessage);

        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated topic object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success.
         */
        $sessionMessage .= " I have updated {$saved_str01}'s record. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_str01'] = "";
        redirect_to("/ax1/Home/page");
    }
}