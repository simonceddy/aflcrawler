<?php
namespace AflCrawler\Console\Commands;

// use AflCrawler\CrawlerFactory;

use AflCrawler\Crawlers\SeasonCrawler;
use AflCrawler\Requester;
use AflCrawler\Util\MakeDomCrawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchSeason extends Command
{
    /**
     * The Requester instance
     *
     * @var Requester
     */
    protected $httpClient;

    /**
     * The SeasonCrawler instance
     *
     * @var SeasonCrawler
     */
    protected $crawler;

    public function __construct(Requester $httpClient, SeasonCrawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('fetch:season')
            ->addArgument(
                'season',
                InputArgument::REQUIRED,
                'The season to crawl'
            )
            ->setDescription(
                'Fetch stats for the given season.'
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $season = $input->getArgument('season');

        $response = $this->httpClient->getSeason((int) $season);

        if (($statusCode = $response->getStatusCode()) !== 200) {
            $output->write(<<<EOT
<error>Invalid response.\n
Response returned with status code {$statusCode}.</error>\n
EOT
            );
        }
        // $ref = new \ReflectionClass($response);

        // dd($ref->getMethods(\ReflectionMethod::IS_PUBLIC));

        // TODO check response is valid

        $domCrawler = MakeDomCrawler::fromResponse($response, 'table');

        $generator = $this->crawler->crawl($domCrawler);

        $fn = ($rootDir = dirname(__DIR__, 3)) . "/seasons/{$season}.json";

        if (!is_dir($seasonsDir = $rootDir . '/seasons')) {
            mkdir($seasonsDir);
        }
        $results = [];

        foreach ($generator as $data) {
            if (count($data) === 2) {
                [$team, $players] = $data;
                $results[] = [
                    'team' => $team, 
                    'players' => $players
                ];
            }
        }

        if (!empty($results)) {
            file_put_contents($fn, json_encode($results, JSON_PRETTY_PRINT));
        }
        dd($generator);
    }
}
