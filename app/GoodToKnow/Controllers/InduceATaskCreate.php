<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\Task;


class InduceATaskCreate
{
    public function page()
    {
        /**
         * Create a database record in the task
         * table using the submitted task label.
         * The remaining field values will be set to default values.
         *
         * $_POST['label']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

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
         * Get label
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);

        if (is_null($label)) {
            $sessionMessage .= " Your label did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Use the submitted data to add a record to the database.
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $array_record = ['user_id' => $user_id, 'label' => $label, 'last' => 0, 'next' => 0, 'cycle_type' => '', 'comment' => ''];

        // In memory object.
        $object = Task::array_to_object($array_record);

        $result = $object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= ' The object\'s save method returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The object\'s save method did not return false but it did send
            back a message. Therefore, it probably did not create a new record. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Wrap it up.
         */
        $sessionMessage .= " 👍 a new <b>task</b> record has been created. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}