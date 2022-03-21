<?php

namespace App;

class Logs 
{

    /**
     * @param string|array $data
     * @return void
     */
    public static function log($data): void
    {
        date_default_timezone_set('Europe/Moscow');

        if (!file_exists(dirname(__FILE__, 1) . '/logs')) {
            mkdir(dirname(__FILE__, 1) . '/logs', 0755);
        }
        $path = dirname(__FILE__, 1) . '/logs/' . date('Y-m-d') . '.txt';
        if (is_string($data)) {
            $log = date('Y-m-d H:i:s') . ' ' . print_r($data, true);
        } else {
            $log = date('Y-m-d H:i:s') . PHP_EOL . print_r($data, true);
        }
        file_put_contents($path, $log . PHP_EOL . '===' . PHP_EOL, FILE_APPEND);
    }
}