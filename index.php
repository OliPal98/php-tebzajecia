<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/view.php');
include_once('./SRC/utils/debug.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$viewParams = [];

if ($action === 'create'){
    $viewParams['resultCreate'] = 'Tworzymy nową notatkę';
} else {
    $viewParams['resultList'] = 'Wyświetlamy listę notatek';
}


$view = new view();


$view->render($action, $viewParams);

?>