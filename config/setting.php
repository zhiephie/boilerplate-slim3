<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // PHP Renderer settings
        'renderer' => [
            'template_path' => PATH_ROOT.'../components/',
        ],

        // Twig View settings
        'view' => [
            'template_path' => PATH_ROOT.'../components/',
            'cache_path' => PATH_ROOT.'../storage/cache/',
            'debug' => true,
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => PATH_ROOT.'../storage/log/server.log',
        ],
		
		// Facebook App
		'facebook' => [
			'app_id' => '',
			'app_secret' => '',
			'default_graph_version' => 'v2.5',
		],
    ],
];
