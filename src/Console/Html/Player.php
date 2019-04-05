<?php
namespace AflCrawler\Console\Html;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AflCrawler\Http\Client;
use Symfony\Component\Console\Input\InputOption;

class Player extends Command
{
    protected function configure()
    {
        $this->setName('html:player')
            ->setDescription(
                'Fetch and store a local copy of a Player page.'
            )
            ->addArgument(
                'player',
                InputArgument::IS_ARRAY,
                'The player name'
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
        $name = array_map(function ($name) {
            return ucfirst(strtolower($name));
        }, ($player = $input->getArgument('player')));
        // todo: validate player
        $name = (implode('_', $name));
        //dd($name);
        $filename = $input->getOption('outputFile') ?? $name.'.html';
        
        $filename = getcwd().'/storage/'.$filename;
        preg_match('/(\.[a-z]+)$/', $filename) ?: $filename .= '.html';
        
        $client = new Client;

        // todo: check connection
        
        $output->writeln('Sending request...');
        $response = $client->getPlayer($name);
        
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
            'player '.$name.' successfully stored in '.$filename
        );
        //dd($result['teams']['wc']);
    }
}
