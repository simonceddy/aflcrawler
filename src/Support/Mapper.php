<?php
namespace AflCrawler\Support;

use AflCrawler\Support\Mappings\MappingsInterface;

class Mapper
{
    /**
     * Attempts to transform a Node into an array conforming to the given
     * MappingsInterface.
     *
     * @param \DOMElement $node
     * @return array
     */
    public static function mapNode(\DOMNode $node, MappingsInterface $mappings)
    {
        $i = 0;
        $data = [];
        foreach ($node->childNodes as $col) {
            $data[$mappings->mappings()[$i]] = $col->textContent;
            $i++;
        }
        return $data;
    }
}
