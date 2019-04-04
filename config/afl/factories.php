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
         * Laravel/Eloquent factories - requires Illuminate\Database and its
         * dependencies.
         */
        'eloquent' => [
            'player' => AflCrawler\Factory\Eloquent\PlayerFactory::class,
            'team' => AflCrawler\Factory\Eloquent\TeamFactory::class,
            'roster' => '',
            'rostered-player' => ''
        ]
    ]
];
