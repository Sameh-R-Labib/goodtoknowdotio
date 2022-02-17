<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\BankingAcctForBalances;

/**
 * @param int $user_id
 * @param int $bank_id
 * @return string
 */
function get_html_select_box_containing_the_bank_accounts(int $user_id, int $bank_id): string
{
    /**
     * This function generates the html for a drop-down select box
     * containing all the banks of a particular user.
     *
     * The bank id argument determines which bank account will appear
     * in the box before the user clicks on it to expand its selections.
     * (the bank account is thus said to be [pre]selected)
     * When editing an existing transaction, the form appears having
     * the existing bank for that transaction already selected in the
     * drop-down selection box.
     */

    global $g;


    /**
     * The current bank account corresponding to $bank_id will be preselected.
     *
     * This is what HTML for a drop-down looks like:
     *         <label for="bank_id" class="dropdown">Bank Account:
     *             <select id="bank_id" name="bank_id">
     *                 <option value="4">Citibank checking</option>
     *                 <option value="7" selected>Bank of America CC</option>
     *             </select>
     *        </label>
     */


    /**
     * First I need to get all the BankingAcctForBalances object for this user.
     */

    $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string($user_id) . '"';

    $array_of_objects = BankingAcctForBalances::find_by_sql($sql);

    if (!$array_of_objects || !empty($g->message)) {

        breakout(' I could NOT find any banking acct for balances ¯\_(ツ)_/¯ ');

    }


    /**
     * Use get_html_select_box to get $html.
     */

    // Generate the array.

    foreach ($array_of_objects as $object) {

        $assoc_array_val_to_text[$object->id] = $object->acct_name;

    }


    require_once CONTROLLERHELPERS . DIRSEP . 'get_html_select_box.php';

    
    return get_html_select_box($bank_id, 'bank_id', "Bank Account:\n", 'dropdown', $assoc_array_val_to_text);
}