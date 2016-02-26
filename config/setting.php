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
			'app_id' => '515777708475394',
			'app_secret' => '930dcf220e95164fc713ada5548a9d54',
			'default_graph_version' => 'v2.5',
		],
    ],
];
