<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\Task;

class InduceATaskCreate
{
    function page()
    {
        /**
         * Create a database record in the task table using the submitted data.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);

        $last = integer_form_field_prep('last', 0, PHP_INT_MAX);

        $next = integer_form_field_prep('next', 0, PHP_INT_MAX);

        $cycle_type = standard_form_field_prep('cycle_type', 3, 60);

        $comment = standard_form_field_prep('comment', 0, 800);


        /**
         * Use the submitted data to add a record to the database.
         */

        $db = get_db();

        $array_record = ['user_id' => $user_id, 'label' => $label, 'last' => $last, 'next' => $next,
            'cycle_type' => $cycle_type, 'comment' => $comment];


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

        breakout(' A <b>task</b> record was created 👍. ');
    }
}