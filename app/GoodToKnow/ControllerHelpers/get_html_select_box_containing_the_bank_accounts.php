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
     * The reason this function needs the $bank_id is to
     * make that bank account selected.
     */

    global $db;
    global $app_state;


    /**
     * The current bank account will be pre selected.
     *
     * This is what HTML for a drop down looks like:
     *         <label for="bank_id" class="dropdown">Bank Account:
     *             <select id="bank_id" name="bank_id">
     *                 <option value="4">Citibank checking</option>
     *                 <option value="7" selected>Bank of America CC</option>
     *             </select>
     *        </label>
     */

    $html = "        <label for=\"bank_id\" class=\"dropdown\">Bank Account:\n";

    $html .= "             <select id=\"bank_id\" name=\"bank_id\">\n";


    /**
     * First I need to get all the BankingAcctForBalances object for this user.
     */

    $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

    $array_of_objects = BankingAcctForBalances::find_by_sql($sql);

    if (!$array_of_objects || !empty($app_state->message)) {

        breakout(' I could NOT find any banking acct for balances ¯\_(ツ)_/¯ ');

    }


    /**
     * Build the options.
     */

    foreach ($array_of_objects as $object) {
        $html .= "                 <option value=\"";

        $html .= $object->id;

        if ($object->id == $bank_id) {
            $html .= "\" selected>";
        } else {
            $html .= "\">";
        }

        $html .= $object->acct_name;

        $html .= "</option>\n";
    }


    /**
     * Close the HTML.
     */

    $html .= "             </select>\n";

    $html .= "        </label>\n";

    return $html;
}