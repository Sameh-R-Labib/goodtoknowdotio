<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;


class GawkAtAllTaxableIncomeEventsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the TaxableIncomeEvent(s/plural) in a page whose layout is similar to the Home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $is_admin;

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
         * 1) Validate the submitted year_received.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_received = integer_form_field_prep('year_received', 1992, 65535);

        if (is_null($year_received)) {
            $sessionMessage .= " Your year_received did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Present the TaxableIncomeEvent(s/plural) in a page whose layout is similar to the Home page.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $db->real_escape_string($year_received);
        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);

        $array = TaxableIncomeEvent::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= " 🤔 For <b>{$year_received}</b> I could NOT find any Taxable Income Events for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Loop through the array and replace attributes with more readable ones.
         */
        foreach ($array as $item) {
            $item->time = self::get_readable_time($item->time);
            $item->comment = nl2br($item->comment, false);
            // Add comma for thousands but keep the number of decimal places at 8 just in case the currency is a crypto.
            require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
            $item->amount = readable_amount_of_money($item->amount);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at One Year of your Taxable 💸 Event 📽s. ';

        $html_title = 'Enjoy ʘ‿ʘ at One Year of your Taxable 💸 Event 📽s.';

        $page = 'GawkAtAllTaxableIncomeEvents';

        $show_poof = true;

        require VIEWS . DIRSEP . 'gawkatalltaxableincomeeventsyearfilter.php';
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