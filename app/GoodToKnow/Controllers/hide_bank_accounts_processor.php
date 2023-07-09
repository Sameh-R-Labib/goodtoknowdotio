<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;

class hide_bank_accounts_processor
{
    function page()
    {
        /**
         * Get the submitted checkboxes. And, use that information to hide
         * their associated banking_acct_for_balances records.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        // This route is similar to the well documented include get_the_submitted_community_ids.php


        require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

        $g->submitted_bankaccount_ids = checkbox_section_form_field_prep('choice-');

        if (empty($g->submitted_bankaccount_ids)) {

            breakout(' You did not submit any bank accounts to hide. ');

        }


        foreach ($g->submitted_bankaccount_ids as $item) {

            if (!is_numeric($item)) {

                breakout(' Unexpectedly one or more id values turned out to be non-numeric. ');

            }
        }


        /**
         * Get all the banking_acct_for_balances records which are not hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'show'";

        $g->array_of_objects = banking_acct_for_balances::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any visible banking acct for balances. ');

        }


        /**
         * Set to 'hide' the banking_acct_for_balances which are in $g->submitted_bankaccount_ids
         */

        $count = 0;

        foreach ($g->array_of_objects as $object) {

            // if $object->id is one of the values in $g->submitted_bankaccount_ids
            // then make $object->visibility equal to 'hide'.
            if (in_array($object->id, $g->submitted_bankaccount_ids)) {

                $object->visibility = 'hide';

                $result = $object->save();

                if ($result === false) {

                    breakout(' Error 844955: I failed at saving a banking_acct_for_balances object. ');

                }

                $count++;
            }
        }


        /**
         * Declare success.
         */

        breakout(" $count to-be-hidden banking_acct_for_balances became hidden. ");

    }
}