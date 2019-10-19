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

        $markdown = <<<DEMO
Regular >>

Inline `>>`

Pre example should appear below.

```
>>
```
DEMO;

        $parser = new MarkdownExtra;
        $parser->no_entities = false;
        $html = $parser->transform($markdown);

        var_dump($html);
    }
}