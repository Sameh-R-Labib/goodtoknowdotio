<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;


class ConceiveAPossibleTaxDeductionProcessor
{
    function page()
    {
        /**
         * Create a database record in the possible_tax_deduction
         * table using the submitted possible_tax_deduction
         * label and year_paid. The remaining field values will be set to default values.
         *
         * $_POST['label'] $_POST['year_paid']
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
         * Get year_paid
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        if (is_null($year_paid)) {
            $sessionMessage .= " Your year_paid did not pass validation. ";
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

        $array_record = ['user_id' => $user_id, 'label' => $label, 'year_paid' => $year_paid, 'comment' => ''];

        // In memory object.
        $object = PossibleTaxDeduction::array_to_object($array_record);

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
        $sessionMessage .= " A new Possible Tax Deduction record was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}