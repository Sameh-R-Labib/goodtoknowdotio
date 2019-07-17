<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class ConceiveAPossibleTaxDeductionProcessor
{
    public function page()
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

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);

        if (is_null($label)) {
            $sessionMessage .= " Your label did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $label = (isset($_POST['label'])) ? $_POST['label'] : '';
        if (empty(trim($label))) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($label) > 264 || strlen($label) < 3) {
            $sessionMessage .= " Either the label is too long or too short. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}