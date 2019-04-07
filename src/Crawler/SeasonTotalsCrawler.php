<?php
namespace AflCrawler\Crawler;

use AflCrawler\Support\Mappings\SeasonTotalsMappings;
use AflCrawler\Util\RegexHelper;
use AflCrawler\Util\TeamResolver;
use Symfony\Component\DomCrawler\Crawler;
use AflCrawler\Support\Traits\CurrentTeamAware;
use AflCrawler\Support\Traits\ErrorStack;
use AflCrawler\Support\Traits\HasFactories;
use AflCrawler\Support\Traits\HasSeason;
use AflCrawler\Support\Mapper;

class SeasonTotalsCrawler implements CrawlerInterface
{
    use HasFactories, HasSeason, ErrorStack, CurrentTeamAware;

    /**
     * The result data
     *
     * @var array
     */
    protected $result = [
        'players' => [],
        'teams' => []
    ];

    /**
     * The Column Mappings
     *
     * @var \AflCrawler\Support\Mappings\MappingsInterface
     */
    protected $map;

    /**
     * Resolver for Team names/locations
     *
     * @var TeamResolver
     */
    private $teamResolver;

    public function __construct(int $season = null)
    {
        !$season ?: $this->setSeason($season);
        $this->map = new SeasonTotalsMappings;
    }

    /**
     * Attempts to locate the season year from the root Crawler instance.
     *
     * @param Crawler $crawler
     * @return void
     */
    private function locateSeasonFromCrawler(Crawler $crawler)
    {
        $title = $crawler->filter('title')->first()->text();
        try {
            $this->setSeason((int) preg_replace('/\D/', '', $title));
        } catch (\Exception $e) {
            $this->errors[] = $e;
            throw $e; // todo: handle errors
        }
    }

    /**
     * Crawls through the response html and returns an array of results.
     * 
     * Results are instances of AflCrawler\Model\ModelInterface
     *
     * @param string $html
     * @return array
     */
    public function crawl(string $html)
    {
        $crawler = new Crawler($html);
        isset($this->season) ?: $this->locateSeasonFromCrawler($crawler);
        $filter = $crawler->filter('table');
        
        foreach ($filter as $el) {
            if ($el->childNodes->count() > 2) {
                $this->crawlNodes($el->childNodes); 
            }
        }
        return $this->result;
    }

    /**
     * Crawls through nodes and attempts to pass data to the appropiate
     * handlers.
     * 
     * Nodes are expected to be table rows.
     *
     * @param \DomNodeList $nodes
     * @return void
     */
    protected function crawlNodes(\DOMNodeList $nodes)
    {
        foreach ($nodes as $node) {
            if (($children = $node->childNodes)->count() > 2
                && false !== $this->tm()
            ) {
                foreach ($children as $child) {
                    $player = Mapper::mapNode($child, $this->map);
                    [$id, $model] = $this->handlePlayer($player);
                    $roster = $this->currentTm->getRoster($this->season);
                    $player['model'] = $model;
                    $roster->addRosteredPlayer(
                        $this->factory('rostered-player')->build($player)
                    );
                    //dd($roster);
                    //$this->factory('rostered-player');
                }
            } elseif(RegexHelper::isTableHeading($node->textContent)) {
                $team = $this->teamFromTableHeading($node);
                if (!isset($this->result['teams'][($team['short'])])) {
                    $this->buildTeam($team);
                }
            }
        }
    }

    /**
     * Attempts to resolve a Team from a table row.
     *
     * @param \DOMElement $node
     * @return array
     */
    private function teamFromTableHeading(\DOMElement $node)
    {
        $team = RegexHelper::getTeamFromHeading(
            $node->textContent
        );
        isset($this->teamResolver) ?: $this->teamResolver = new TeamResolver;
        $teamData = $this->teamResolver->resolve($team);
        if (!$teamData) {
            throw new \LogicException('Invalid team: '.$team);
        }
        return $teamData;
        
    }

    /**
     * Handles resolving or creating a player from given data
     *
     * @todo Resolving players
     * 
     * @param array $player
     * @return array
     */
    protected function handlePlayer(array $player)
    {
        // todo: make better
        $id = $this->tm().$player['number'];
        if (!isset($this->result['players'][$id])) {
            $this->result['players'][$id] = $this->factory('player')
                ->build($player);
        }
        return [$id, $this->result['players'][$id]];
    }

    protected function buildTeam(array $teamData)
    {
        $team = $this->factory('team')->build($teamData);
        $team->addRoster($this->factory('roster')->build([
            'team' => $team,
            'season' => $this->getSeason()
        ]));
        $this->result['teams'][$team->getShortName()] = $team;
        $this->currentTm = $team;
        return $team;
    }
}
