<?php

declare(strict_types=1);

namespace App;

require_once('./Exception/AppException.php');
require_once('./Exception/ConfigurationException.php');
require_once('./Exception/StorageException.php');
include_once('./SRC/controller.php');
include_once('./SRC/utils/debug.php');
require_once('./config/config.php');

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use Throwable;

$request = [
    'get' => $_GET,
    'post' => $_POST,
];

try {
Controller::initConfiguration($configuration);
$controller = new controller($request);
$controller->run();
} catch (AppException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo '<h3>' . $e->getMessage() . '</h3>';
} catch (Throwable $e){
    echo "<h1> Wystąpił błąd w aplikacji</h1>";
}

?>