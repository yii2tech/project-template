<?php
/**
 * Application initialization console command entry script.
 *
 * In order to initialize application run the following console command:
 * php install.php init
 *
 * To get help type:
 * php install.php help init
 *
 * In order to run this script in automatic mode use the following:
 * php install.php init --interactive=0 --config=/path/to/my/config/install.php
 */

$basePath = __DIR__;

$hostName = @exec('hostname');
if (empty($hostName)) {
    $hostName = 'unknownhost.com';
}

$userName = @exec('whoami');
if (empty($userName)) {
    $userName = 'root';
}

$isDebugServer = (stripos($hostName, 'debug') !== false || stripos($hostName, 'devel') !== false || stripos($hostName, 'devplatform') !== false);

// Adjust the application configuration if necessary:
$config = [
    'id' => 'project-installer',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'name' => 'MyProject',
    'controllerMap' => [
        'init' => [
            'class' => 'yii2tech\install\InitController',
            'localDirectories' => [
                '@app/web/assets',
                '@runtime',
            ],
            'tmpDirectories' => [
                '@app/web/assets',
                '@runtime/URI',
                '@runtime/HTML',
                '@runtime/debug',
                '@runtime/gii',
            ],
            'localFiles' => [
                '@app/web/.htaccess',
                '@app/webstub/.htaccess',
                '@app/config/local.php',
                '@app/config/self-update.php',
                '@app/tests/codeception/backend/codeception.yml',
                '@app/tests/codeception/backend/acceptance.suite.yml',
                '@app/tests/codeception/frontend/codeception.yml',
                '@app/tests/codeception/frontend/acceptance.suite.yml',
            ],
            'localFilePlaceholders' => [
                'yiiDebug' => [
                    'hint' => 'Debug mode, should be 1 at development server and 0 - at production',
                    'default' => $isDebugServer ? '1' : '0',
                    'type' => 'boolean',
                ],
                'yiiEnv' => [
                    'hint' => 'Application environment, The value could be "prod" (production), "dev" (development), "test", "staging", etc.',
                    'default' => $isDebugServer ? 'dev' : 'prod',
                    'type' => 'string',
                ],
                // Database:
                'dbHost' => [
                    'hint' => 'Database hostname: ip address or domain name, usually: "localhost"',
                    'default' => $isDebugServer ? 'mysql.dev.server.com' : 'localhost',
                ],
                'dbName' => [
                    'hint' => 'Database name (make sure such database exists)',
                    'default' => 'myproject',
                ],
                'dbUser' => [
                    'hint' => 'Database access user name',
                    'default' => $userName,
                ],
                'dbPassword' => [
                    'hint' => 'Database access password',
                    //'default' => '???',
                ],
                // URL fallback for console application :
                'hostInfo' => [
                    'hint' => 'URL for the web server root (domain name with leading protocol)',
                    'default' => $isDebugServer ? "http://debug.server.com/{$userName}/myproject/" : 'http://' . $hostName,
                    'rules' => [
                        ['url']
                    ],
                ],
                'baseUrl' => [
                    'hint' => 'Part of the URL, which leads for the project web root. At the live server it is usually empty, in development - "/developer/myproject"',
                    'default' => '',
                ],
            ],
            'commands' => [
                "php {$basePath}/yii migrate/up --interactive=0"
            ],
            // Cron jobs :
            /*'cronTab' => [
                'mergeFilter' => "php {$basePath}/yii ",
                'jobs' => [
                    [
                        'min' => '0',
                        'hour' => '0',
                        'command' => "php {$basePath}/yii some-cron",
                    ],
                ],
            ],*/
        ],
    ],
];

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

$autoloadFile = $basePath . '/vendor/autoload.php';
if (!file_exists($autoloadFile)) {
    $composerBin = file_exists($basePath . '/composer.phar') ? $basePath . '/composer.phar' : 'composer';
    passthru('(cd ' . escapeshellarg($basePath) . "; {$composerBin} global require 'fxp/composer-asset-plugin:^1.2.0'; {$composerBin} install)");
}

require($autoloadFile);
require($basePath . '/vendor/yiisoft/yii2/Yii.php');

$application = new yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);