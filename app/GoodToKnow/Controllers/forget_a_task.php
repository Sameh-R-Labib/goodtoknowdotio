<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;

class forget_a_task
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us which task record he wants to delete. It will present
         * a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);


        $g->array = task::find_by_sql($sql);

        if (!$g->array) {

            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯ ');

        }


        $g->html_title = 'Which task?';


        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}