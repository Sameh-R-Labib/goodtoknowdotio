<?php

namespace GoodToKnow\Controllers;

class balance_out_the_sequence_numbers_modify
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();

        if ($g->type_of_resource_requested === 'post') {

            breakout(' It is not possible to run this operation on a post. ');

        }


        $g->thing_type = $g->type_of_resource_requested;

        if ($g->thing_type === 'community') {

            $g->thing_name = $g->community_name;

        } else {

            $g->thing_name = $g->topic_name;

        }


        if ($g->thing_type === 'community') {

            // Assemble $g->fields for topic records. One html line for each record.
            foreach ($g->saved_arr01 as $object) {

                // $object is current record
                $g->fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $g->fields .= "<input type=\"text\" value=\"{$object->sequence_number}\"";
                $g->fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"11\" required > ";
                $g->fields .= $object->topic_name;
                $g->fields .= "</p>\n";

            }
        } else {

            // Assemble $g->fields for post records. One html line for each record.
            foreach ($g->saved_arr01 as $object) {
                // $object is current record
                $g->fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $g->fields .= "<input type=\"text\" value=\"{$object->sequence_number}\" ";
                $g->fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"11\" required > ";
                $g->fields .= $object->title;
                $g->fields .= "</p>\n";

            }
        }


        $g->html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}