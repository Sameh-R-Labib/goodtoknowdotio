<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\Task;

class InduceATaskCreate
{
    function page()
    {
        /**
         * Create a database record in the task
         * table using the submitted task label.
         * The remaining field values will be set to default values.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * Get label
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);


        /**
         * Use the submitted data to add a record to the database.
         */

        $db = get_db();

        $array_record = ['user_id' => $user_id, 'label' => $label, 'last' => 0, 'next' => 0, 'cycle_type' => '', 'comment' => ''];


        // In memory object.

        $object = Task::array_to_object($array_record);

        $result = $object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' The object\'s save method returned false. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The object\'s save method did not return false but it did send
            back a message. Therefore, it probably did not create a new record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A <b>task</b> record has been created 👍. ');
    }
}