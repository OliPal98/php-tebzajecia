<?php

declare(strict_types=1);

namespace App;

use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use Exception;
use PDO;
use PDOException;

class database
{
    public function __construct(array $config)
    {
        try {
        $this->validateConfig($config);
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $connection = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
        );
    } catch (PDOException $e) {
        throw new StorageException('Błąd w połączeniu z bazą danych');
    }
}

private function validateConfig(array $config): void
{
    if(empty($config['database']) || empty($config['user']) || empty($config['host'])) {
        throw new ConfigurationException('Problem z konfiguracją połączenia do bazy danych. Skontaktuj się z administratorem.');
    }
}
}