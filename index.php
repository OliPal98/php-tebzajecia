<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/view.php');
include_once('./SRC/utils/debug.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$viewParams = [];

if ($action === 'create'){
    $page = 'create';
    $created = false;
    if (!empty($_POST)){
        $viewParams = [
            'title'=>$_POST['title'],
            'description'=>$POST['description'],
        ];
        $created = true;
    }
    $viewParams['created'] = $created;
} else {
    $page = 'list';
    $viewParams['resultList'] = 'Wyświetlamy listę notatek';
}




$view = new view();
$view->render($page, $viewParams);

?>