<?php
namespace AflCrawler\Crawler;

use AflCrawler\Model\Player;
use AflCrawler\Model\Team;
use AflCrawler\Support\Mappings\SeasonTotalsMappings;
use AflCrawler\Util\RegexHelper;
use AflCrawler\Util\TeamResolver;
use Symfony\Component\DomCrawler\Crawler;
use AflCrawler\Support\Traits\HasFactories;

class SeasonTotalsCrawler implements CrawlerInterface
{
    use HasFactories;

    protected $result = [];

    protected $map;

    public function __construct()
    {
        $this->map = (new SeasonTotalsMappings)->mappings();
        
    }

    public function crawl(string $html)
    {
        $crawler = (new Crawler($html))->filter('table');
        foreach ($crawler as $el) {
            if ($el->childNodes->count() > 2) {
                $this->crawlNodes($el->childNodes); 
            }
        }
        return $this->result;
    }

    protected function crawlNodes($nodes)
    {
        $team = null;
        $resolver = null;
        foreach ($nodes as $node) {
            if (($children = $node->childNodes)->count() > 2
                && null !== $team
            ) {
                foreach ($children as $child) {
                    $i = 0;
                    $player = [];
                    foreach ($child->childNodes as $col) {
                        $player[$this->map[$i]] = $col->textContent;
                        $i++;
                    }
                    $player['model'] = $this->factory('player')
                        ->build($player);
                    $this->result[$team][$player['number']] = $player;
                    $this->factory('rostered-player');
                }
            } elseif(RegexHelper::isTableHeading($node->textContent)) {
                $team = RegexHelper::getTeamFromHeading(
                    $node->textContent
                );
                if (!$resolver) {
                    $resolver = new TeamResolver;
                }
                $teamData = $resolver->resolve($team);
                if (!$teamData) {
                    throw new \LogicException('Invalid team: '.$team);
                }
                $model = $this->factory('team')->build($teamData);
                $team = $teamData['short'];
                isset($this->result[$team]) ?: $this->result[$team] = [
                    'model' => $model
                ];
            }
        }
    }
}
