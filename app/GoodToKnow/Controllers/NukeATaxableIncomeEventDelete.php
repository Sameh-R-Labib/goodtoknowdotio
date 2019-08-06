<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;


class NukeATaxableIncomeEventDelete
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event record id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted taxable_income_event record id in the session.
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
         * 2) Retrieve the taxable_income_event object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that taxable_income_event record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        /**
         * Replace attributes with more readable ones.
         */
        $object->time = self::get_readable_time($object->time);
        $object->comment = nl2br($object->comment, false);
        // Add comma for thousands but keep the number of decimal places at 8 just in case the currency is a crypto.
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        $object->amount = readable_amount_of_money($object->amount);

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'nukeataxableincomeeventdelete.php';
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