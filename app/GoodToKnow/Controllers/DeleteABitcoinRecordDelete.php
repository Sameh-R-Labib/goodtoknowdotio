<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;

class DeleteABitcoinRecordDelete
{
    public function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the bitcoin record. If yes then
         * delete it. On the other hand if no then reset
         * some session variables and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            $sessionMessage .= " You didn't enter a choice. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if ($choice == "no") {
            $_SESSION['saved_int01'] = 0;
            $sessionMessage .= " You've changed your mind about deleting the bitcoin record. So, none was deleted. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $_SESSION['saved_int01'] = 0;
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $bitcoin = Bitcoin::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$bitcoin) {
            $sessionMessage .= " I wasn't able to find the bitcoin record and I've aborted the procedure which you've started. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $result = $bitcoin->delete($db, $sessionMessage);
        if (!$result) {
            $_SESSION['saved_int01'] = 0;
            $sessionMessage .= " Unexpectedly I could not delete bitcoin record. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Report successful deletion of post.
        $_SESSION['saved_int01'] = 0;
        $sessionMessage .= " I have successfully deleted the ₿ record. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}