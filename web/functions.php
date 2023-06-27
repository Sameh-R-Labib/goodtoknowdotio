<?php

use GoodToKnow\Models\status;

/**
 * @param string $html
 */
function fix_michelf(string &$html)
{
    // Fix bugs caused by MarkdownExtra
    $bad = array("&amp;amp;", "&amp;lt;");
    $good = array("&amp;", "&lt;");
    $html = str_replace($bad, $good, $html);
}


/**
 * @return void
 */
function offline_enforcement()
{
    global $g;

    $elapsed_time = time() - $g->when_last_checked_system_status_offline;

    if ($elapsed_time > 52 and !$g->is_admin) {

        /**
         * Enforce offline status.
         */

        $g->when_last_checked_system_status_offline = time();

        $_SESSION['when_last_checked_system_status_offline'] = $g->when_last_checked_system_status_offline;

        db_connect_if_not_connected();


        /**
         * Get the system status object.
         */

        $status_object = status::find_by_id(1);

        if (!$status_object) {
            breakout(' ERROR: 581471547. ');
        }

        if ($status_object->name !== 'normal' and $status_object->name !== 'offline') {
            breakout(' ERROR: 1471 The status name is invalid. ');
        }

        if ($status_object->message !== 'The system is operating with normal status.' and
            $status_object->message !== 'The system is operating with offline status.') {

            breakout(' ERROR: 1471 The status message is invalid. ');

        }


        /**
         * Kick out the user.
         */

        if ($status_object->name == 'offline') {

            $g->message .= " System running in Offline mode. ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }
    }
}


/**
 * Gtk.io uses this particular kick out function for
 * Read / Show features because these features may
 * carry over a message from the feature which may
 * have run before it.
 *
 * @return void
 */
function kick_out_loggedoutusers()
{
    global $g;

    if (!$g->is_logged_in or $_SESSION['agree_to_tos'] !== 'agree') {

        breakout(' Either your session has expired or you did not agree to the T.O.S. ');

    }

    offline_enforcement();
}


/**
 * Overall perspective:
 *  -- kick_out_loggedoutusers_or_if_there_is_error_msg is NOT used on the cover_page page. However, it is used on most of the other pages.
 *  -- If there is no session file then $g->is_logged_in will be null (and thus breakout will happen.)
 *  -- If there is a message then breakout will happen.
 * Breakout just means control is handed over to the cover_page page.
 * In the case where there is no session file the cover_page page will log out the user.
 * In the case where there is a message the cover_page page will show that message.
 *
 * Also: offline_enforcement().
 */
function kick_out_loggedoutusers_or_if_there_is_error_msg()
{
    global $g;

    if (!$g->is_logged_in || !empty($g->message) || $_SESSION['agree_to_tos'] !== 'agree') {
        breakout(' Either your session expired or an error message was generated. ');
    }

    offline_enforcement();
}


/**
 *
 */
function kick_out_nonadmins()
{
    global $g;

    if (!$g->is_logged_in || !$g->is_admin || $_SESSION['agree_to_tos'] !== 'agree') {
        breakout(' Either you\'re not authorized, your session expired, there is an error message, or you did not agree to the T.O.S. ');
    }
}


/**
 *
 */
function reset_feature_session_vars()
{
    // We are doing this in case user chooses to abort. If he chooses to abort
    // then we won't get the opportunity to do this while the form is being processed.

    $_SESSION['is_first_attempt'] = true;


    $_SESSION['saved_str01'] = '';
    $_SESSION['saved_str02'] = '';
    $_SESSION['saved_int01'] = 0;
    $_SESSION['saved_int02'] = 0;
    $_SESSION['saved_arr01'] = [];
    $_SESSION['saved_arr02'] = [];
    $_SESSION['saved_arr03'] = [];
}


/**
 * @param string $location
 */
function redirect_to(string $location)
{
// This function takes a string which normally
// goes in a Location header. Then places it in
// a Location header. Then exits the script.
// Although the script has terminated, its output
// will be sent to the browser (including the
// Location header. Output buffering must be set
// to be on for this to work.

    /**
     * OUR GOAL: The routes which do NOT present a view must pass on
     * their "to display message" to the next route.
     *
     * There are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $g;

    $_SESSION['message'] = $g->message;

    if ($location !== '') {
        header("Location: $location");
        exit;
    }
}


/**
 * @param string $newMessage
 */
function breakout(string $newMessage)
{
    /**
     * OUR GOAL: The routes which do NOT present a view must pass on
     * their "to display message" to the next route.
     *
     * There are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $g;

    $g->message .= $newMessage;
    reset_feature_session_vars();

    /**
     * See main comment in clear_session_vars.
     * It will explain one of the subtleties
     * of the use of $g->controller_name.
     */

    switch ($g->controller_name) {
        case 'set_home_community_topic_post':
        case 'home':
            redirect_to("/ax1/infinite_loop_prevent/page");
            break;
        case 'edit_my_post_edit_processor':
        case 'edit_my_post_direct':
        case 'create_new_post':
        case 'edit_post_title':
        case 'edit_my_post':
        case 'author_deletes_own_post':
        case 'author_deletes_own_post_choose_post':
        case 'edit_post_title_choose_post':
        case 'edit_my_post_choose_post':
        case 'move_post_instruct':
            redirect_to("/ax1/home/page");
            break;
        case 'feature_a_task_link':
        case 'induce_a_task':
        case 'forget_a_task':
        case 'forget_a_task_processor':
            redirect_to("/ax1/glance_at_my_tasks/page");
            break;
        case 'build_a_banking_transaction_for_balances':
        case 'revamp_a_banking_transaction_for_balances':
        case 'revamp_a_banking_transaction_for_balances_choose_record':
        case 'check_my_banking_account_tx_balances':
        case 'omit_a_banking_transaction_for_balances':
        case 'omit_a_banking_transaction_for_balances_choose_record':
        case 'omit_a_banking_transaction_for_balances_delete':
        case 'transfer_an_amount':
        case 'reset_all_b_accounts_instruct':
        case 'transfer_an_amount_form_processor':
            redirect_to("/ax1/c_p_transactions/page");
            break;
        case 'generate_a_banking_account_for_balances':
        case 'populate_a_banking_account_for_balances':
        case 'populate_a_banking_account_for_balances_processor':
        case 'annul_a_banking_acct_for_balances':
        case 'annul_a_banking_acct_for_balances_processor':
            redirect_to("/ax1/c_p_banking_accounts/page");
            break;
        case 'produce_a_bank_acct_observer':
        case 'produce_a_bank_acct_observer_processor':
        case 'destroy_a_bank_acct_observer':
        case 'destroy_a_bank_acct_observer_processor':
            redirect_to("/ax1/c_p_banking_observers/page");
            break;
        case 'make_a_recurring_payment_record':
        case 'polish_a_recurring_payment_record':
        case 'polish_a_recurring_payment_record_processor':
        case 'expunge_a_recurring_payment_record':
        case 'expunge_a_recurring_payment_record_processor':
            redirect_to("/ax1/c_p_recurring_payments/page");
            break;
        case 'conceive_a_possible_tax_deduction':
        case 'alter_a_possible_tax_deduction':
        case 'alter_a_possible_tax_deduction_edit':
        case 'alter_a_possible_tax_deduction_year_filter':
        case 'see_one_years_possible_tax_deductions':
        case 'wipe_out_a_possible_tax_deduction':
        case 'wipe_out_a_possible_tax_deduction_year_filter':
        case 'wipe_out_a_possible_tax_deduction_delete':
            redirect_to("/ax1/c_p_tax_deductions/page");
            break;
        case 'start_a_taxable_income_event':
        case 'write_over_a_taxable_income_event':
        case 'write_over_a_taxable_income_event_year_filter':
        case 'write_over_a_taxable_income_event_edit':
        case 'gawk_at_all_taxable_income_events':
        case 'nuke_a_taxable_income_event':
        case 'nuke_a_taxable_income_event_year_filter':
        case 'nuke_a_taxable_income_event_delete':
        case 'add_income_commodity':
            redirect_to("/ax1/c_p_taxable_income/page");
            break;
        case 'initialize_a_commodity_record':
        case 'edit_a_commodity_record':
        case 'edit_a_commodity_record_processor':
        case 'commodity_see_my_records_specify':
        case 'delete_a_commodity_record':
        case 'delete_a_commodity_record_processor':
            redirect_to("/ax1/c_p_commodities/page");
            break;
        case 'father_a_commodity_sold':
        case 'fine_tune_a_commodity_sold':
        case 'fine_tune_a_commodity_sold_year_filter':
        case 'fine_tune_a_commodity_sold_edit':
        case 'spy_commodities_sold':
        case 'drop_a_commodity_sold':
        case 'drop_a_commodity_sold_year_filter':
        case 'drop_a_commodity_sold_delete':
        case 'process_a_commodity_sale':
            redirect_to("/ax1/c_p_capital_gains/page");
            break;
        case 'changed_posts_and_images':
        case 'pick_off_some':
        case 'delete_recent_uploads':
            redirect_to("/ax1/c_p_changed_content/page");
            break;
        case 'balance_out_the_sequence_numbers':
        case 'balance_out_the_sequence_numbers_form_processor':
        case 'balance_out_the_sequence_numbers_modify':
        case 'new_community':
        case 'kommunity_description_editor':
        case 'kommunity_description_editor_form':
        case 'new_topic_insert_point':
        case 'new_topic_name':
        case 'topic_description_editor':
        case 'topic_description_editor_form':
        case 'quick_post_delete':
        case 'quick_post_delete_choose_post':
        case 'quick_post_delete_delete':
        case 'transfer_post_ownership':
        case 'transfer_post_ownership_choose_post':
        case 'transfer_post_ownership_get_post':
        case 'transfer_post_ownership_get_username':
            redirect_to("/ax1/c_p_postings/page");
            break;
        case 'admin_pass_code_generation_form':
        case 'admin_pass_code_gen_form_processor':
        case 'reset_a_passphrase':
        case 'reset_a_passphrase_enter_a_passphrase':
        case 'give_communities_to_user':
        case 'give_coms_choices':
        case 'remove_communities_from_a_user':
        case 'remove_coms_choices':
        case 'member_memo_editor':
        case 'member_memo_editor_form':
        case 'suspend_account':
        case 'unsuspend_account':
            redirect_to("/ax1/c_p_accounts/page");
            break;
        case 'set_system_wide_alert':
        case 'offline_the_system':
        case 'purge_old_messages':
        case 'liquidate_years_possible_tax_deductions':
        case 'cleanup_years_taxable_income_events':
        case 'abolish_years_commodities_sold':
            redirect_to("/ax1/c_p_purges/page");
            break;
        default:
            redirect_to("/ax1/cover_page/page");
    }
}


/**
 * @param int $size
 * @return string
 */
function size_as_text(int $size): string
{
    // takes a size in bytes and returns a more use friendly equivalent
    if ($size < 1024) {
        return "$size bytes";
    } elseif ($size < 1048576) {
        $size_kb = round($size / 1024);
        return "$size_kb KB";
    } else {
        $size_mb = round($size / 1048576, 1);
        return "$size_mb MB";
    }
}


/**
 * @return bool|mysqli
 */
function db_connect()
{
    global $g;

    try {

        $g->db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($g->db->connect_error) {
            $g->message .= ' ' . htmlspecialchars($g->db->connect_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;
        }

        $g->db->set_charset('utf8mb4');

    } catch (Exception $e) {

        $g->message .= ' ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        return false;

    }

    return $g->db;
}


/**
 * Also see comment for db_connect_if_not_connected().
 *
 * @return bool|mysqli
 */
function get_db()
{
    global $g;

    $g->db = db_connect();

    if ($g->db === false) {
        breakout(' I was unable to connect to the database. ');
    }

    return $g->db;
}

/**
 * We use db_connect_if_not_connected() rather than get_db()
 * when we want to connect ONLY IF we don't already have a connection.
 */
function db_connect_if_not_connected()
{
    global $g;

    if (is_null($g->db)) {
        $g->db = db_connect();
        if ($g->db === false) {
            breakout(" Failed to connect to the database. ");
        }
    }
}
