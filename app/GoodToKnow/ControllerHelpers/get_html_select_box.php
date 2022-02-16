<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $preselected_option_value
 * @param string $name
 * @param string $label_text
 * @param string $class_of_box
 * @param array $assoc_array_val_to_text
 * @return string
 */
function get_html_select_box(string $preselected_option_value, string $name, string $label_text, string $class_of_box,
                             array  $assoc_array_val_to_text): string
{
    /**
     * "select box" and "drop-down" are the same thing.
     *
     * What each parameter represents
     *  - $preselected_option_value: Each option has a value and a text. This parameter specifies the value for the
     *                               option which is to be preselected.
     *  - $name:                     Name of select box html element.
     *  - $label_text:               Text for label of select box html element.
     *  - $class_of_box:             css class for this type of select box.
     *  - $assoc_array_val_to_text:  An array where each element corresponds with an option.
     *                               The key of the element is the value of the option.
     *                               The value of the element is text of the option.
     */

    $html = "        <label for=\"$name\" class=\"$class_of_box\">$label_text\n";

    $html .= "             <select id=\"$name\" name=\"$name\">\n";


    /**
     * Build the options.
     */

    foreach ($assoc_array_val_to_text as $value => $text) {

        $html .= "                 <option value=\"";

        $html .= $value;

        if ($value === $preselected_option_value) {
            $html .= "\" selected>";
        } else {
            $html .= "\">";
        }

        $html .= $text;

        $html .= "</option>\n";

    }


    /**
     * Close the HTML.
     */

    $html .= "             </select>\n";

    $html .= "        </label>\n";


    return $html;
}