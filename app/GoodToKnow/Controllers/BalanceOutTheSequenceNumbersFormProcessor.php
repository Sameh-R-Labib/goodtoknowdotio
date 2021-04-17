<?php


namespace GoodToKnow\Controllers;


class BalanceOutTheSequenceNumbersFormProcessor
{
    function page()
    {
        /**
         * 1) Make sure array element $_POST['animal'] is itself an array (aka. "that array.)
         *    That array must have keys which correspond to record id fields.
         *    The value field of each element of that array must contain the submitted sequence_number value.
         *    String is the type of value of all form submits.
         * 2) Retrieve the same $result set which was retrieved in the previous route.
         * 3) Replace the sequence_number of each record in $result with its corresponding one from $_POST['animal'].
         * 4) Save $result to the session.
         * 5) Present all the contents of $result in the view (which will be the type of view with round corners.)
         *    The records should and will be in order by sequence_number.
         * 6) Present a Save button and a Cancel button.
         *    **These buttons will be link buttons instead of form submit buttons.**
         */

        global $thing_type;
        global $html_title;
        global $is_admin;
        global $is_logged_in;;
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;

        /**
         * Preliminary things to take care of.
         */

        kick_out_nonadmins();

        $thing_type = ucfirst($type_of_resource_requested);

        /**
         * 1) Make sure array element $_POST['animal'] is itself an array (aka. "that array.)
         *    That array must have keys which correspond to record id fields.
         *    The value field of each element of that array must contain the submitted sequence_number value.
         *    String is the type of value of all form submits.
         */

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbersformprocessor.php';
    }
}