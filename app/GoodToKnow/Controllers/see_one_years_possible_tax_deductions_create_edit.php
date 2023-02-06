<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\possible_tax_deduction;

class see_one_years_possible_tax_deductions_create_edit
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();


        $sql = 'SELECT * FROM `possible_tax_deduction` WHERE `year_paid` = ' . $g->db->real_escape_string((string)$g->saved_int02);
        $sql .= ' AND `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

        $g->array = possible_tax_deduction::find_by_sql($sql);

        if (!$g->array) {

            breakout(" For <b>$g->saved_int02</b> I could NOT find any Tax Deductions. ");

        }


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($g->array as $item) {

            $item->comment = nl2br($item->comment, false);

        }

        $g->html_title = "$g->saved_int02's possible tax deductions.";

        $g->page = 'see_one_years_possible_tax_deductions';

        $g->show_poof = true;

        $g->year_paid = $g->saved_int02;


        /**
         * This is similar to doing a breakout but there is no redirect,
         * and it does not present the home page itself.
         */

        $g->message .= " Here are <b>$g->saved_int02</b>'s Tax Deductions. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}