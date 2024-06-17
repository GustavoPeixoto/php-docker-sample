<?php

namespace App\Database;

use PDO;

class Mysql extends PDO
{
    private static Mysql $instance;

    private function __construct(...$args)
    {
        parent::__construct(...$args);
    }

    public static function instance(): self
    {
        if (!isset(self::$instance)) {
            $config = [
                'host' => 'mysql',
                'port' => 3306,
                'dbname' => $_ENV['MYSQL_DATABASE'],
                'user' => $_ENV['MYSQL_USER'],
                'pass' => $_ENV['MYSQL_PASSWORD'],
            ];

            $config['dsn'] = sprintf(
                'mysql:host=%s;port=%s;dbname=%s',
                $config['host'],
                $config['port'],
                $config['dbname']
            );

            self::$instance = new Mysql(
                $config['dsn'],
                $config['user'],
                $config['pass']
            );
        }

        return self::$instance;
    }
}
