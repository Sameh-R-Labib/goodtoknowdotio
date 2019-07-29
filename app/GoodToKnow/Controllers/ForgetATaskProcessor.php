<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class ForgetATaskProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the task record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the task object with that id from the database.
         *    And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for permission to delete.
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
         * 1) Determines the id of the task record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the task object with that id from the database.
         *    And, format its attributes for easy viewing.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $object = Task::find_by_id($db, $sessionMessage, $chosen_id);

        // Format its attributes for easy viewing.
        $object->last = self::get_readable_time($object->time);
        $object->next = self::get_readable_time($object->next);

        /**
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */
        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'forgetataskprocessor.php';
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $created
     * @return string
     */
    public static function get_readable_time($created)
    {
        $created = (int)$created;
        $date = date('m/d/Y h:ia ', $created) . "<small>[" . date_default_timezone_get() . "]</small>";
        return $date;
    }
}