<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Task;

class GlanceAtMyTasks
{
    function page()
    {
        /**
         * Display all tasks for the user.
         */

        global $user_id;
        global $sessionMessage;
        global $is_logged_in;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);
        $array = Task::find_by_sql($db, $sessionMessage, $sql);
        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any tasks for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */
        foreach ($array as $object) {
            $object->last = self::get_readable_time($object->last);
            $object->next = self::get_readable_time($object->next);
            $object->comment = nl2br($object->comment, false);
        }

        $html_title = 'All my Tasks';

        $page = 'GlanceAtMyTasks';

        $show_poof = true;

        $sessionMessage .= ' Enjoy ʘ‿ʘ at all your To-do Tasks/💪s. ';

        require VIEWS . DIRSEP . 'glanceatmytasks.php';
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