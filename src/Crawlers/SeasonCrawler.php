<?php
namespace AflCrawler\Crawlers;

use AflCrawler\AflCrawler;
use AflCrawler\Util\LoopOverNodes;
use AflCrawler\Util\NodeToCols;
use AflCrawler\Util\RunGenerator;
use AflCrawler\Util\TableHeading;
use Symfony\Component\DomCrawler\Crawler;

class SeasonCrawler implements AflCrawler
{
    /**
     * Array of results from running the Crawler
     *
     * @var array
     */
    protected $results = [];

    /**
     * Array of Generators created by the crawler.
     *
     * @var \Generator[]
     */
    protected $generators = [];

    /**
     * Array of columns in the order they will be processed.
     *
     * @var string[]
     */
    protected $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    protected function processNodes(\DOMNodeList $nodes)
    {
        $generator = LoopOverNodes::generator($nodes, function ($node) {
            if (($children = $node->childNodes)->count() > 2) {
                $players = LoopOverNodes::generator($children, function ($child) {
                    return NodeToCols::map($child, $this->columns);
                });
                return RunGenerator::run($players);
            } elseif (TableHeading::matches($node->textContent)) {
                $team = TableHeading::extractFrom($node->textContent);
                return $team;
            }
        });
        
        return RunGenerator::run($generator);
    }

    /**
     * Create a crawler for an AFL Tables season stats page.
     * 
     * Returns a Generator.
     *
     * @param Crawler $crawler
     *
     * @return \Generator
     */
    public function crawl(Crawler $crawler)
    {
        foreach ($crawler as $el) {
            if ($el->childNodes->count() <= 2) {
                // dd($el->textContent);
                continue;
            }
            yield $this->processNodes($el->childNodes);
        }
    }
}
