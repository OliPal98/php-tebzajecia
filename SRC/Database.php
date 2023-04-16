<?php

declare(strict_types=1);

namespace App;

use PDO;

class database
{
    public function __construct(array $config)
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $connection = new PDO('ssssss');
    }
}