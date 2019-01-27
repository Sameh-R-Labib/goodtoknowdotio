<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-13
 * Time: 22:01
 */

namespace GoodToKnow\Controllers;


class GiveComsChoicesProcessor
{
    public function page()
    {
        /**
         * $_POST array looks something like this:
         *
         * array(5) {
         *   ["choice-1"]=> string(1) "3"
         *   ["choice-2"]=> string(1) "8"
         *   ["choice-3"]=> string(2) "12"
         *   ["choice-4"]=> string(2) "15"
         *   ["submit"]=> string(6) "Submit"
         * }
         */

        /**
         * Instead what we need is an array like this:
         *
         * array(4) {
         *   [0]=> string(1) "3"
         *   [1]=> string(1) "8"
         *   [2]=> string(2) "12"
         *   [3]=> string(2) "15"
         * }
         */
    }
}