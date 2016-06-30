<?php
/**
 * Configuration file for the "backend" test (web/admin-test.php) web application
 */

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/backend.php',
    [
        'bootstrap' => [
            function () {
                if (isset($_SERVER['REMOTE_ADDR']) && !empty($GLOBALS['developerIPs'])) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $allowedIPs = $GLOBALS['developerIPs'];
                    foreach ($allowedIPs as $filter) {
                        if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                            return;
                        }
                    }
                    Yii::warning('Access to Test Application is denied due to IP address restriction. The requested IP is ' . $ip);
                    die('You are not allowed to access this file.');
                }
            }
        ],
        'components' => [
            'urlManager' => [
                'showScriptName' => true,
            ],
        ],
    ]
);