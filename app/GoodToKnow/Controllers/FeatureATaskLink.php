<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;

class FeatureATaskLink
{
    function page(int $id)
    {
        /**
         * This function handles the request received when a user clicks on a link
         * on the Show Tasks page.
         *
         * This function is a modified version of FeatureATaskEdit. The difference is that
         * this function will get the id of the task from the request itself.
         *
         * A lot of comments were left out since the code was essentially copied from
         * FeatureATaskEdit.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Edit the task record';


        get_db();


        $_SESSION['saved_int01'] = $id;

        $g->object = Task::find_by_id($id);

        if (!$g->object) {

            breakout(' Unexpectedly, I could not find that task. ');

        }

        if ($g->object->user_id != $g->user_id) {

            breakout(' Error 46985423. ');

        }


        /**
         * Present a form which is populated with data from the task object.
         */

        /**
         * This type of record has a field called `last` and a field called `next`. We are Not going to pre-populate
         * form fields with them. Instead, we derive the arrays called $g->last and $g->next from them and use
         * the derived arrays to pre-populate the corresponding fields in the form which we present below.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->last = get_date_h_m_s_from_a_timestamp($g->object->last);

        $g->next = get_date_h_m_s_from_a_timestamp($g->object->next);


        /**
         * The reason we need these particular variable names
         * is that the form is also used by the redo.
         * All the form's variables are elements of $g->saved_arr01.
         */

        $g->saved_arr01['label'] = $g->object->label;
        $g->saved_arr01['cycle_type'] = $g->object->cycle_type;
        $g->saved_arr01['comment'] = $g->object->comment;
        $g->saved_arr01['lastdate'] = $g->last['date'];
        $g->saved_arr01['lasthour'] = $g->last['hour'];
        $g->saved_arr01['lastminute'] = $g->last['minute'];
        $g->saved_arr01['lastsecond'] = $g->last['second'];
        $g->saved_arr01['nextdate'] = $g->next['date'];
        $g->saved_arr01['nexthour'] = $g->next['hour'];
        $g->saved_arr01['nextminute'] = $g->next['minute'];
        $g->saved_arr01['nextsecond'] = $g->next['second'];
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone (the hours minutes and seconds above are
        // for this timezone)


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'featureataskedit.php';
    }
}