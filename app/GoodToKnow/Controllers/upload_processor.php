<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;

class upload_processor
{
    function page()
    {
        /**
         * REPEATING:
         * The goal of this series of routes is to make it possible to upload
         * an image file (jpg, jpeg, png, gif) to the IMAGE folder on the server
         * and to save its URL to the session variable called url_of_most_recent_upload.
         * It shall do all this while making sure the upload contains no malicious code.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        if (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {

            breakout(' You did not select a file. ');

        }


        /**
         * Start
         */

        $target_dir = IMAGE . DIRSEP;


        /**
         * This value is going to show up a lot.
         * It is the file name in the most classical sense (filename.extension)
         */

        define('CLASSICFILENAME', basename($_FILES["fileToUpload"]["name"]));


        /**
         * Store in a var the file name (w/ its path)
         * where the uploaded content will permanently
         * live.
         *
         * NOTE: The entire old file name (w/ extension) is used for the new file name.
         */

        $target_file = $target_dir . CLASSICFILENAME;


        /**
         * Get a string value for the file type based
         * on the file name's extension.
         *
         * pathinfo with PATHINFO_EXTENSION simply gets the extension.
         */

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        /**
         * Run the getimagesize function on the temporarily uploaded file.
         * Doing so it will either return false if that file is not an image file,
         * or it will return an array which contains some useful information about
         * the file including its mime type.
         *
         * NOTE: $_FILES["fileToUpload"]["tmp_name"]
         *       is the temporarily uploaded file/path.
         */

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);


        /**
         * Store the return value of getimagesize() (i.e. $image_file_mime_type).
         * Or kick out the user if upload is NOT an image.
         */

        $image_file_mime_type = '';

        if ($check !== false) {

            $image_file_mime_type = $check["mime"];

        } else {

            // File is not an image.
            breakout(' Error 546224. ');

        }


        /**
         * Check if file already exists.
         */

        if (file_exists($target_file)) {

            breakout(' The file already exists. ');

        }


        /**
         * Check file size.
         */

        if ($_FILES["fileToUpload"]["size"] > 5767168) {

            breakout(' Your file is too large. ');

        }


        /**
         * Allow (only) certain file formats.
         *
         * NOTE: Although at this point we know it's an image we do NOT know it's a web image
         */

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

            breakout(' Only JPG, JPEG, PNG & GIF files are allowed. ');

        }

        // This strpos() function call will return 0 if the file mime type starts with 'image/'. Otherwise, it will
        // return false.
        // Thus, $is_image will be true if the file mime type starts with 'image/'. Otherwise, $is_image will be false.
        $is_image = (strpos($image_file_mime_type, 'image/') === 0);

        if (!$is_image) {

            breakout(' Error 0076810. ');

        }


        /**
         * Sanity helpers.
         */

        $a_link_href_content = SERVER_URL . '/image/' . rawurlencode(CLASSICFILENAME);

        $a_link_href_content = htmlspecialchars($a_link_href_content, ENT_NOQUOTES | ENT_HTML5);

        $a_link_display_text = SERVER_URL . '/image/' . rawurlencode(CLASSICFILENAME);

        $a_link_display_text = htmlspecialchars($a_link_display_text, ENT_NOQUOTES | ENT_HTML5);

        $a_link_entire_embed = '<a href="' . $a_link_href_content . '" target="_blank">' . $a_link_display_text . '</a>';


        /**
         * Save the file if we are able to move it to its permanent location.
         */

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $g->message .= " The file " . CLASSICFILENAME . " has been uploaded and it is an {$image_file_mime_type}
            file. Here's the link: " . $a_link_entire_embed . ". ";

            $_SESSION['url_of_most_recent_upload'] = $a_link_href_content;


            /**
             * Here, create and save a new changed_content.
             * This changed_content object creates a historical record of the fact that a
             * new upload image file was created. This is part of a system which enables the administrator
             * to monitor new content.
             *
             * First, I will make sure I have all the pieces of information needed to build
             * the changed_content object.
             */

            // id <-- will be generated automatically.

            // time <-- time()

            // name <-- $a_link_entire_embed

            // type <-- 'image_upload'

            // post_id <-- 0

            // expires <-- time() + 3024000  (that is 35 days away from now.)

            $changed_content_array = ['time' => time(), 'name' => $a_link_entire_embed, 'type' => 'image_upload', 'post_id' => 0,
                'expires' => time() + 3024000];

            $changed_content_object = changed_content::array_to_object($changed_content_array);

            $result = $changed_content_object->save();

            if (!$result) {

                breakout(' Unexpected I was unable to save the new changed_content object. ');

            }

            breakout('');

        } else {

            breakout(' Error 5890242. ');

        }
    }
}