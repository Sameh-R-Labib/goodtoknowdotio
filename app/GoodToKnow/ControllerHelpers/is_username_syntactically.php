<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $message
 * @param string $username
 * @return bool
 */
function is_username_syntactically(string &$message, string &$username): bool
{
    /**
     * Returns true if $username fits the requirements for what a GTK.io username.
     * Otherwise returns false.
     *
     * Side Effects: - $username will be trimmed.
     *               - $message may be modified.
     *               - $username will have removed characters with ASCII value < 32
     */

    /**
     * Trim it.
     * Can't be empty.
     * Must consist of two words separated by an underscore.
     * The first word must start with an upper case letter.
     * That first letter is the only uppercase letter.
     * The first word must be 4 to 9 characters in length.
     * The second word is numeric two digits long.
     * Remove characters with ASCII value < 32
     */

    $username = trim($username);

    if (empty($username)) {

        $message .= " The username field was empty. ";

        return false;
    }


    $words = explode('_', $username);


    /**
     * If array $words doesn't have exactly two elements then fail.
     */

    if (count($words) != 2) {

        $message .= " The username must have two parts separated by an underscore character. ";

        return false;
    }

    $last_word = $words[1];
    $first_word = $words[0];


    /**
     * The first word must be all alphabetical letters.
     */

    $is_all_alpha = ctype_alpha($first_word);

    if (!$is_all_alpha) {

        $message .= " The username's first part must have alphabet characters only. ";

        return false;
    }


    /**
     * The first word must start with an upper case letter.
     */

    $arr_of_chars = str_split($first_word);

    $first_char_as_string = $arr_of_chars[0];

    $is_cap = ctype_upper($first_char_as_string);

    if (!$is_cap) {

        $message .= " The username needs to start with a capital letter. ";

        return false;
    }


    /**
     * That first letter is the only uppercase letter.
     */

    $rest = substr($first_word, 1);

    $is_lower = ctype_lower($rest);

    if (!$is_lower) {

        $message .= " The username's first part has a letter with improper case. ";

        return false;
    }


    /**
     * The first word must be 4 to 9 characters in length.
     */

    $length = strlen($first_word);

    if ($length > 9 || $length < 4) {

        $message .= " The username's first part doesn't have a proper length. ";

        return false;
    }


    /**
     * The second word is numeric two digits long.
     */

    $length_of_second_word = strlen($last_word);

    if ($length_of_second_word != 2) {

        $message .= " The username's second part is not two digits. ";

        return false;
    }

    if (!is_numeric($last_word)) {

        $message .= " The username's second part is not numeric. ";

        return false;
    }

    /**
     * Remove characters with ASCII value < 32
     */

    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

    return true;
}