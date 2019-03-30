<?php
return [
    'use' => 'basic',
    'groups' => [
        'basic' => [
            'player' => AflCrawler\Factory\Basic\PlayerFactory::class,
            'team' => AflCrawler\Factory\Basic\TeamFactory::class,
            'roster' => AflCrawler\Factory\Basic\RosterFactory::class,
            'rostered-player' => AflCrawler\Factory\Basic\RosteredPlayerFactory::class,
        ]
    ]
];
