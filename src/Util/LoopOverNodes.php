<?php
namespace AflCrawler\Util;

class LoopOverNodes
{
    public static function generator(\DOMNodeList $nodes, callable $callback)
    {
        foreach ($nodes as $node) {
            yield call_user_func($callback, $node);
        }
    }
}
