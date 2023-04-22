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

try {
Controller::initConfiguration($configuration);
$controller = new controller($_GET, $_POST);
$controller->run();
} catch (AppException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo '<h3>' . $e->getMessage() . '</h3>';
    dump($e);
} catch (Throwable $e){
    echo "<h1> Wystąpił błąd w aplikacji</h1>";
}

?>