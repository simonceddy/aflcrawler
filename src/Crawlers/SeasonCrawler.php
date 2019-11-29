<?php
namespace AflCrawler\Crawlers;

use AflCrawler\AflCrawler;
use AflCrawler\Util\LoopOverNodes;
use AflCrawler\Util\NodeToCols;
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
                $data = [];

                $players = LoopOverNodes::generator($children, function ($child) {
                    return NodeToCols::map($child, $this->columns);
                });

                // dd($players);

                foreach ($players as $child) {
                    // dd($child->textContent);
                    $data[] = $child;
                }

                return $data;

            } elseif (TableHeading::matches($node->textContent)) {
                $team = TableHeading::extractFrom($node->textContent);
                return $team;
            }
        });

        $data = [];
        foreach ($generator as $process) {
            if (!$process) {
                continue;
            }
            $data[] = $process;
        }

        return $data;
    }

    public function crawl(Crawler $crawler)
    {
        foreach ($crawler as $el) {
            if ($el->childNodes->count() <= 2) {
                // dd($el->textContent);
                continue;
            }
            [$team, $players] = $this->processNodes($el->childNodes);
            $this->results[$team] = [
                'team' => $team,
                'players' => $players
            ];
        }

        return $this->results;
    }
}
