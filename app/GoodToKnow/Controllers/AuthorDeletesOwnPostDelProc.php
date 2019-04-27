<?php


namespace GoodToKnow\Controllers;


class AuthorDeletesOwnPostDelProc
{
    public function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the post. If yes then
         * delete the post record, delete its
         * TopicToPost record, and delete its
         * html and markdown files. On the other
         * hand if no then reset some session variables
         * and redirect to the home page.
         */
    }
}