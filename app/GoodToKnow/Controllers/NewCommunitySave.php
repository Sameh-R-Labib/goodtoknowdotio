<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


class NewCommunitySave
{
    function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        $community_as_array = ['community_name' => $saved_str01, 'community_description' => $saved_str02];
        $community = Community::array_to_object($community_as_array);

        $result = $community->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " NewCommunitySave::page says: Unexpected save was unable to save the new community. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        // Redirect
        $sessionMessage .= " 😃 The new community has been created. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_str01'] = "";
        $_SESSION['saved_str02'] = "";
        redirect_to("/ax1/Home/page");
    }
}