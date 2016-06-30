<?php
return [
    'interactive' => false,
    'localFilePlaceholders' => [
        'yiiDebug' => [
            'hint' => 'Debug mode, should be 1 at development server and 0 - at production',
            'default' => '1',
            'type' => 'boolean',
        ],
        'yiiEnv' => [
            'hint' => 'Application environment, The value could be "prod" (production), "dev" (development), "test", "staging", etc.',
            'default' => 'test',
            'type' => 'string',
        ],
        'dbHost' => [
            'hint' => 'Database hostname: ip address or domain name, usually: "localhost"',
            'default' => 'localhost',
        ],
        'dbName' => [
            'hint' => 'Database name (make sure such database exists)',
            'default' => 'yii2test',
        ],
        'dbUser' => [
            'hint' => 'Database access user name',
            'default' => 'travis',
        ],
        'dbPassword' => [
            'hint' => 'Database access password',
            'default' => '',
        ],
        'hostInfo' => [
            'hint' => 'URL for the web server root (domain name with leading protocol)',
            'default' => 'http://localhost',
            'rules' => [
                [
                    'url',
                ],
            ],
        ],
        'baseUrl' => [
            'hint' => 'Part of the URL, which leads for the project web root. At the live server it is usually empty, in development - "/developer/myproject"',
            'default' => '',
        ],
    ],
];