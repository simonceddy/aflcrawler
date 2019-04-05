<?php
namespace AflCrawler\Console\Html;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AflCrawler\Http\Client;
use Symfony\Component\Console\Input\InputOption;

class Matches extends Command
{
    protected function configure()
    {
        $this->setName('html:matches')
            ->setDescription(
                'Fetch and store a local copy of a Season\'s matches page.'
            )
            ->addArgument(
                'season',
                InputArgument::REQUIRED,
                'The season to fetch'
            )
            ->addOption(
                'outputFile',
                'O',
                InputOption::VALUE_REQUIRED,
                'The name of the outputted file relative to current directory.'
            )

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $season = (int) $input->getArgument('season');
        
        $filename = $input->getOption('outputFile') ?? $season.'_matches.html';
        
        $filename = getcwd().'/storage/'.$filename;
        preg_match('/(\.[a-z]+)$/', $filename) ?: $filename .= '.html';
        
        $client = new Client;

        // todo: check connection
        
        $output->writeln('Sending request...');
        $response = $client->getMatches($season);
        
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
            'Matches for season '.$season.' successfully stored in '.$filename
        );
        //dd($result['teams']['wc']);
    }
}
