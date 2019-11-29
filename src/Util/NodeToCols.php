<?php
namespace AflCrawler\Util;

class NodeToCols
{
    public static function map(
        \DOMNode $node,
        array $cols,
        callable $callback = null
    ) {
        $i = 0;
        $data = [];
        foreach ($node->childNodes as $col) {
            $data[$cols[$i]] = $col->textContent;
            $i++;
        }
        return $data;
    }
}
