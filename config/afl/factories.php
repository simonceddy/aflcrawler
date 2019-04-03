<?php
return [
    'use' => 'basic',
    'groups' => [
        
        /**
         * Default factories - requires no extra dependencies
         */
        'basic' => [
            'player' => AflCrawler\Factory\Basic\PlayerFactory::class,
            'team' => AflCrawler\Factory\Basic\TeamFactory::class,
            'roster' => AflCrawler\Factory\Basic\RosterFactory::class,
            'rostered-player' => AflCrawler\Factory\Basic\RosteredPlayerFactory::class,
        ],

        /**
         * Laravel/Eloquent factories
         */
        'eloquent' => [
            'player' => '',
            'team' => '',
            'roster' => '',
            'rostered-player' => ''
        ]
    ]
];
