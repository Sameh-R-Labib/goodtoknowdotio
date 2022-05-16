<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class set_system_wide_alert_proc
{
    function page()
    {
        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $name = standard_form_field_prep('name', 1, 12);

        $values = ['system_alert', 'no_alert'];

        if (!in_array($name, $values)) {

            breakout(' You choice of alert name is invalid. ');

        }


        $message = standard_form_field_prep('message', 4, 230);


        $status_object = status::find_by_id(2);


        if (!$status_object) {

            breakout(' ERROR 48582878: No status object found. ');

        }

        if ($status_object->name !== 'system_alert' and $status_object->name !== 'no_alert') {

            breakout(' ERROR 3904844: The status name is invalid. ');

        }


        $status_object->name = $name;
        $status_object->message = $message;


        $result = $status_object->save();


        if ($result === false) {

            breakout(' Error 274812: I failed at saving status object (likely because no changes were made to it.) ');

        }


        breakout(" The system status for <b>$status_object->name</b> has been saved 👌🏽. ");

    }
}