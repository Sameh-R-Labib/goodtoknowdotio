<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class FineTuneACommoditySoldEdit
{
    function page()
    {
        /**
         * 1) Store the submitted commodities_sold id in the session.
         * 2) Retrieve the commodities_sold object with that id from the database.
         * 3) Make sure the object belongs to this user.
         * 4) Present a form which is populated with data from the commodities_sold object.
         */


        /** @var $object */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_commodity_sold.php';


        /**
         * 4) Present a form which is populated with data from the commodities_sold object.
         */

        /**
         * This type of record has a field called `time_bought` and a field called `time_sold`. We are Not going to
         * pre-populate form fields with them. Instead we derive the arrays called $time_bought and $time_sold from them
         * and use the derived arrays to pre-populate the corresponding fields in the form which we present below.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time_bought = get_date_h_m_s_from_a_timestamp($object->time_bought);

        $time_sold = get_date_h_m_s_from_a_timestamp($object->time_sold);


        /**
         * Make it so that if price_bought is fiat then price_bought has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $object->price_bought = readable_amount_no_commas($object->currency_transacted, $object->price_bought);


        /**
         * Make it so that if price_sold is fiat then price_sold has only two decimal places.
         */

        $object->price_sold = readable_amount_no_commas($object->currency_transacted, $object->price_sold);


        /**
         * Make it so that if commodity_amount is fiat then commodity_amount has only two decimal places.
         */

        $object->commodity_amount = readable_amount_no_commas($object->commodity_type, $object->commodity_amount);


        $html_title = 'Edit the commodity sold';

        require VIEWS . DIRSEP . 'finetuneacommoditysoldedit.php';
    }
}