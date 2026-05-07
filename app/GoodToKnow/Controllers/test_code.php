<?php

namespace GoodToKnow\Controllers;

use Michelf\MarkdownExtra;

class test_code
{
    function page()
    {
        /**
         * I'm trying to figure out why my scripts with Markdown parsers are excessively converting
         * html special characters especially when code blocks or inline code is involved.
         */


        global $g;


        $g->markdown = <<<DEMO

The ampersand symbol &

The ampersand entity sequence for less than &lt;

The less than symbol <

The greater than symbol >

Regular >>  >

Inline code `>>  >`

Pre example should appear below.

```
>>
```
DEMO;

        $parser = new MarkdownExtra;
        $parser->no_entities = false;
        $html = $parser->transform($g->markdown);

        echo 'before fix_michelf' . "\n <br><br>";

        var_dump($html);

        // Call to global function
        fix_michelf($html);


        echo 'after fix_michelf' . "\n <br><br>";

        var_dump($html);
    }
}