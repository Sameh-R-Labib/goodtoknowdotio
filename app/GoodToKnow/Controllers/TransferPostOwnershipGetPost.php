<?php


namespace GoodToKnow\Controllers;


class TransferPostOwnershipGetPost
{
    /**
     * This route will (1) determine
     * which post the admin chose to do a transfer of ownership to,
     * (2) stores the post's info in the session, and
     * (3) presents a form asking the user if he
     * is sure this is the post he wants to transfer the ownership of.
     *
     * For step (3):
     * Based on the submitted post id the script will
     * derive and present:
     *  - Community name
     *  - Topic name
     *  - Post title | extensionfortitle
     *  - Author username
     */
}