<?php


namespace GoodToKnow\Controllers;


class TopicDescriptionEditorProcessor
{
    public function page()
    {
        /**
         * Essentially what this function will do is
         * it will process the form where the admin
         * chose the topic which he wants to edit the
         * description of. The name of the submitted
         * selection is $_POST['choice']. And its value
         * is the id of the topic selected by the admin.
         *
         * So what this function will do is:
         *  1) Validate the submission.
         *  2) Save the topic id in the session.
         *  3) Save the topic name in the session (we know what that is from the $special_topic_array.)
         *  4) Redirect to a function which will bring up the editor for the description.
         */
    }
}