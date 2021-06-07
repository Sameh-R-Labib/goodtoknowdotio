<?php

namespace GoodToKnow\Controllers;

use Michelf\MarkdownExtra;

class TestCode
{
    function page()
    {
        /**
         * I'm trying to figure out why my scripts with markdown parsers are excessively converting
         * html special characters especially when code blocks or inline code is involved.
         */


        global $g;


        $g->markdown = <<<DEMO
Regular >>

Inline `>>`

Pre example should appear below.

```
>>
```
DEMO;

        $parser = new MarkdownExtra;
        $parser->no_entities = false;
        $html = $parser->transform($g->markdown);

        // Call to global function
        fix_michelf($html);


        var_dump($html);
    }
}