<?php

global $g;

echo "<a href=\"/ax1/home/page\"><img src=\"/img/blog_home.gif\" alt=\"blog home\" height=\"18\" width=\"18\"></a>" . " ≬ ";

switch ($g->page) {
    case 'cover_page':
        echo "<a href=\"/ax1/cover_page/page\">Cover Page</a>";
        break;
    case 'inbox':
        echo "<a href=\"/ax1/inbox/page\">Inbox</a>";
        break;
    case 'admin':
        echo "<a href=\"/ax1/admin_home/page\">Admin Home</a>";
        break;
    case 'cp':
        echo "<a href=\"/ax1/control_panel/page\">Control Panel</a>";
        break;
    case 'user_roster':
        echo "<a href=\"/ax1/user_roster/page\">User Roster</a>";
        break;
    case 'commodity_see_my_records':
        echo "<a href=\"/ax1/commodity_see_my_records_specify/page\">List My Commodity Records</a>";
        break;
    case 'about':
        echo "<a href=\"/ax1/what_is_this_site/page\">What is this site?</a>";
        break;
    case 'recurring_payment_see_my_records':
        echo "<a href=\"/ax1/recurring_payment_see_my_records/page\">See All Recurring Payments</a>";
        break;
    case 'view_all_banking_accounts_for_balances':
        echo "<a href=\"/ax1/view_all_banking_accounts_for_balances/page\">Bank Accounts And Their Starting Balances</a>";
        break;
    case 'show_all_bank_acct_observers':
        echo "<a href=\"/ax1/show_all_bank_acct_observers/page\">Bank Account Observers You Own</a>";
        break;
    case 'check_my_banking_account_tx_balances':
        echo "<a href=\"/ax1/check_my_banking_account_tx_balances/page\">See Transactions</a>";
        break;
    case 'see_one_years_possible_tax_deductions':
        echo "<a href=\"/ax1/see_one_years_possible_tax_deductions/page\">1 Year's Tax Deductions</a>";
        break;
    case 'glance_at_my_tasks':
        echo "<a href=\"/ax1/glance_at_my_tasks/page\">All My Tasks</a>";
        break;
    case 'gawk_at_all_taxable_income_events':
        echo "<a href=\"/ax1/gawk_at_all_taxable_income_events/page\">A Year's Taxable Income Events</a>";
        break;
    case 'spy_commodities_sold_year_filter':
        echo "<a href=\"/ax1/spy_commodities_sold/page\">One Year's Commodity Sold Records</a>";
        break;
    case 'c_p_basics':
        echo "<a href=\"/ax1/c_p_basics/page\">Blog And Message</a>";
        break;
    case 'c_p_transactions':
        echo "<a href=\"/ax1/c_p_transactions/page\">Banking Transaction</a>";
        break;
    case 'c_p_recurring_payments':
        echo "<a href=\"/ax1/c_p_recurring_payments/page\">Recurring Payment</a>";
        break;
    case 'c_p_banking_accounts':
        echo "<a href=\"/ax1/c_p_banking_accounts/page\">Bank Account</a>";
        break;
    case 'c_p_banking_observers':
        echo "<a href=\"/ax1/c_p_banking_observers/page\">Bank Observer</a>";
        break;
    case 'c_p_commodities':
        echo "<a href=\"/ax1/c_p_commodities/page\">Commodity</a>";
        break;
    case 'c_p_tax_deductions':
        echo "<a href=\"/ax1/c_p_tax_deductions/page\">Tax Deduction</a>";
        break;
    case 'c_p_to_do_list':
        echo "<a href=\"/ax1/c_p_to_do_list/page\">Task</a>";
        break;
    case 'c_p_taxable_income':
        echo "<a href=\"/ax1/c_p_taxable_income/page\">Taxable Income Event</a>";
        break;
    case 'c_p_capital_gains':
        echo "<a href=\"/ax1/c_p_capital_gains/page\">Commodity Sold</a>";
        break;
    case 'c_p_purges':
        echo "<a href=\"/ax1/c_p_purges/page\">System Maintenance</a>";
        break;
    case 'c_p_server':
        echo "<a href=\"/ax1/c_p_server/page\">Server</a>";
        break;
    case 'c_p_accounts':
        echo "<a href=\"/ax1/c_p_accounts/page\">User Management</a>";
        break;
    case 'c_p_postings':
        echo "<a href=\"/ax1/c_p_postings/page\">Blog Management</a>";
        break;
    case 'c_p_changed_content':
        echo "<a href=\"/ax1/c_p_changed_content/page\">Changed Content</a>";
        break;
    case 'changed_posts_and_images':
        echo "<a href=\"/ax1/changed_posts_and_images/page\">Changed Posts and Uploaded Images</a>";
        break;
    case 'proclamation':
        echo "<a href=\"/ax1/proclamation/page\">Proclamation</a>";
        break;
    case 'find_too_close_sequence_numbers':
        echo "<a href=\"/ax1/find_too_close_sequence_numbers/page\">Find Too Close Sequence Numbers</a>";
        break;
    case 'process_a_commodity_sale_save':
        echo "<a href=\"/ax1/process_a_commodity_sale/page\">Process A Commodity Sale</a>";
        break;
    default:
        require CURRENTCOMMUNITY;
        require CURRENTTOPIC;
        require CURRENTPOST;
}
