<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\get_html_select_box_containing_the_bank_accounts;

class RevampABankingTransactionForBalancesEdit
{
    function page()
    {
        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the banking_transaction_for_balances object.
         */


        /** @var $object */
        /** @var $db */
        /** @var $user_id */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingtransactionforbalances.php';


        /**
         * 4) Present a form which is populated with data from the banking_transaction_for_balances object.
         *
         * Note: Replace bank_id with the HTML for the drop down select box. Then use bank_id in the HTML form
         * to supply the HTML for that input field.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $object->bank_id = get_html_select_box_containing_the_bank_accounts($db, $user_id, $object->bank_id);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($object->time);

        $html_title = 'Edit the banking_transaction_for_balances record';

        require VIEWS . DIRSEP . 'revampabankingtransactionforbalancesedit.php';
    }
}