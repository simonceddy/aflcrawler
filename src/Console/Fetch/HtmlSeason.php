<?php
namespace AflCrawler\Console\Fetch;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AflCrawler\Http\Client;

class HtmlSeason extends Command
{
    protected function configure()
    {
        $this->setName('fetch:html:season')
            ->setDescription(
                'Fetch and store a local copy of a single season\'s html.'
            )
            ->addArgument(
                'season',
                InputArgument::REQUIRED,
                'The season year'
            )
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'The name of the outputted file relative to current directory.'
            )

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $season = $input->getArgument('season');
        // todo: validate season
        $filename = $input->getArgument('filename');
        
        $filename = getcwd().'/'.$filename;
        preg_match('/(\.[a-z]+)$/', $filename) ?: $filename .= '.html';
        
        $client = new Client;

        // todo: check connection
        
        $output->writeln('Sending request...');
        $response = $client->getSeason((int) $season);
        
        $output->writeln('Received response.');
        
        // check $response status

        $html = $response->getBody()->getContents();
        try {
            file_put_contents($filename, $html);
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return;
        }

        $output->writeln(
            'Season '.$season.' successfully stored in '.$filename
        );
        //dd($result['teams']['wc']);
    }
}
