<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/controller.php');
include_once('./SRC/utils/debug.php');




$controller = new controller($_GET, $_POST);
$controller->run();

?>