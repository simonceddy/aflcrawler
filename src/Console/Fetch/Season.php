<?php
namespace AflCrawler\Console\Fetch;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AflCrawler\Http\Client;
use AflCrawler\Crawler\SeasonTotalsCrawler;
use Symfony\Component\Console\Input\InputOption;

class Season extends Command
{
    protected function configure()
    {
        $this->setName('fetch:season')
            ->setDescription(
                'Fetch and parse data for a single season.'
            )
            ->addArgument(
                'season',
                InputArgument::REQUIRED,
                'The season year'
            )
            ->addOption(
                'fromFile',
                'F',
                InputOption::VALUE_REQUIRED,
                'Crawl a locally stored HTML file.'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $season = $input->getArgument('season');
        // todo: validate season
        
        if (!$path = $input->getOption('fromFile')) {
            $client = new Client;
            // todo: check connection
            
            $output->writeln('Sending request...');
            $response = $client->getSeason((int) $season);
            
            $output->writeln('Received response.');
            
            // check $response status
    
            $html = $response->getBody()->getContents();
        } else {
            if (!file_exists($fn = getcwd().'/'.$path)
                && !file_exists($fn = $fn.'.html')
            ) {
                $output->writeln('<error>Could not locate '.$path.'</error>');
                return;
            }
            $output->writeln('Located file...');
            $output->writeln('Reading content...');
            $html = file_get_contents($fn);
        }

        
        $crawler = new SeasonTotalsCrawler($season);
        $output->writeln('Crawling response...');
        $result = $crawler->crawl($html);
        dd($crawler->factories());
    }
}
