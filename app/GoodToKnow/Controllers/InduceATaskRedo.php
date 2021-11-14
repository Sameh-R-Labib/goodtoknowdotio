<?php

namespace GoodToKnow\Controllers;

class InduceATaskRedo
{
    function page()
    {

        /**
         * Reset 'is_first_attempt' in the session.
         *
         * We are setting 'is_first_attempt' to false so that once the user submits the form,
         * and it is being processed it will not be retested for anomalous time entries.
         */

        $_SESSION['is_first_attempt'] = false;
    }
}