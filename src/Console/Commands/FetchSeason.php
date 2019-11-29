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

        $results = $this->crawler->crawl($domCrawler);
        dd(count(end($results)['players']));
    }
}
