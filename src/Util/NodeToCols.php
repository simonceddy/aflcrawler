<?php
namespace AflCrawler\Util;

class NodeToCols
{
    /**
     * Map the children of a DOMNode to the given columns. 
     *
     * @param \DOMNode $node
     * @param \Traversable $cols
     * @param callable $callback
     *
     * @return array
     */
    public static function map(
        \DOMNode $node,
        \Traversable $cols,
        callable $callback = null
    ) {
        $i = 0;
        $data = [];

        foreach ($node->childNodes as $col) {
            $content = $col->textContent;
            
            $key = $cols[$i];

            if (is_callable($callback)) {
                $data[$key] = call_user_func($callback, $content, $key);
            } else {
                $data[$key] = $content;
            }
            $i++;
        }
        return $data;
    }
}
