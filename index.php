<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/view.php');
include_once('./SRC/utils/debug.php');

$action = $_GET['action'] ?? null;


$view = new view();
$view->render($action);

?>